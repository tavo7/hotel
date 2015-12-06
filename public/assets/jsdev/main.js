window.$(document).ready(function() {
	localStorage.clear();
	$('body').timeago();
	window.routers.base = new Hotel.Routers.Base();
	window.variables.iddetallecompra = 1;
	window.views.app =new Hotel.Views.App( $('body') );
	window.views.appcaja =new Hotel.Views.AppCaja( $('body') );
	window.views.appordenes =new Hotel.Views.AppOrdenes( $('body') );
	window.collections.detallecompra = new Hotel.Collections.Detallecompra();
	window.collections.pisos = new Hotel.Collections.Pisos();
	window.collections.tiposhabitacion = new Hotel.Collections.TiposHabitacion();
	window.collections.habitaciones = new Hotel.Collections.Habitaciones();
	window.collections.productos = new Hotel.Collections.Productos();
	window.collections.productoscesta = new Hotel.Collections.ProductosCesta();

	window.collections.detallecompra.on('add', function (model) {
		var view = new Hotel.Views.Detallecompra({model: model});
		view.renderedit();
		view.$el.appendTo('.productos-lista');
	});

	window.collections.tiposhabitacion.on('add',function(model) {
		var view = new Hotel.Views.TipoHabitacion({model: model});
		view.render();
		view.$el.appendTo('.tiposhabitacion');
	});

	window.collections.habitaciones.on('add',function(model) {
		var view = new Hotel.Views.Habitacion({model: model});
		view.render();
		view.$el.appendTo('.habitaciones');
	});

	window.collections.productoscesta.on('add',function(model) {
		var view = new Hotel.Views.ProductoCesta({model: model});
		view.render();
		view.$el.appendTo('.cesta');
		var newtotal = window.collections.productoscesta.sumaprecio();
		$('.sumaprecios').text(newtotal);
	});

	var xhr = window.collections.pisos.fetch();
		xhr = window.collections.tiposhabitacion.fetch();
		xhr = window.collections.habitaciones.fetch();
		xhr = window.collections.productos.fetch();

	window.collections.detallecompra.fetch();
	xhr.done(function () {
		console.log('Start app');
		Backbone.history.start({
			root : '/caja',
			pushState: true,
			silent : false
		});
	});

	if ($("#productos").length) {
		var data = JSON.parse($("#productos").val());
		_.each(data, function(i) {
			 var detalle = {
						preciocompra:i.pivot.preciocompra, 
						cantidad:i.pivot.cantidad, 
						cantidadtotal:i.pivot.cantidadtotal, 
						preciototal:i.pivot.preciototal, 
						preciounitario:i.pivot.preciounitario, 
						presentacion:i.pivot.presentacion, 
						producto_id:i.id,
						unidadmedida:i.pivot.unidadmedida,
						productonombre: i.nombre
					};
					console.log(detalle);
			var model = new Hotel.Models.Detallecompra(detalle);
			window.collections.detallecompra.add(model);
			model.save();
		});
	}

	$('.search_persona').autocomplete({
        source: function( request, response ) {
            $.ajax({
                type: "GET",
                url: "/personas",
                dataType: "json",
                data: {
                featureClass: "P",
                style: "full",
                maxRows: 12,
                name_startsWith: request.term,
                q: request.term
               	},
            success: function(data) {
             response( $.map( data, function( item ) {
                            var name = item.nombre;
                            if(name == null){
                                name = item.razonsocial;
                            }
	                        return {
	                        label: name,
	                        value: name,
	                        id:item.id,
	                        dni: item.dni,
	                        rzsocial:item.razonsocial,
	                        ruc: item.ruc
	                        }
        			}));
                  }
            });
        },
        minLength: 3,
        select: function( event, ui ) {
        	var persona_id = ui.item.id;
        	$('#persona_id').val(persona_id);
        	if (ui.item.dni == null) {
             	$('.persona_nombre').val(ui.item.rzsocial);
        		$('.persona_dni').val(ui.item.ruc);
        		return false;
        	}else{
        		$('.persona_nombre').val(ui.item.value);
        		$('.persona_dni').val(ui.item.dni);
        		return false;
        	}
        }
    });

	$('#arqueo').on('change', function(event) {
		event.preventDefault();
		/* Act on the event */
		var diferencia = Number($('#cantidadteorica').val()) - Number($(this).val());
		$('#diferencia').val(diferencia.toFixed(2));
	});

	$(".btn_deletealquiler").on('click', function(event){
		event.preventDefault();
		window.variables.itemid = $(this).attr('data-item');
		window.variables.detalleid = $(this).attr('data-id');
		window.variables.tipo = 1;
		$('#motivo').val('');
		$('.motivo').toggle();
	});

	$(".btn_deleteproduct").on('click', function(event){
		event.preventDefault();
		window.variables.itemid = $(this).attr('data-item');
		window.variables.detalleid = $(this).attr('data-id');
		window.variables.tipo = 2;
		$('#motivo').val('');
		$('.motivo').toggle();
	});

    $('.btn_editalquiler').on('click',function(event){
        event.preventDefault();
        var idprecio = '#precio_'+$(this).attr('data-id');
        var iddescripcion = '#descripcion_'+$(this).attr('data-id');

        $.ajax({
            url: '/editaralquiler',
            type: 'POST',
            dataType: 'json',
            data: { detalleid:$(this).attr('data-id') , pedido_id: $('#datos').attr('data-pedidoid'),
                    precio: $(idprecio).val(), descripcion: $(iddescripcion).val()}
        })
            .done(function(data) {
                if (data['estado']== true) {
                    alert(data['msg']);
                    window.location.href = "/caja/habitacion-order/"+$('#datos').attr('data-id');
                }else{
                    alert('Operacion No completada');
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });

	$('body').on('click','.btn_aceptaranulacion',function(event){
		event.preventDefault();
		if (window.variables.tipo == 1) {
			anularalquiler(window.variables.itemid, window.variables.detalleid, $('#motivo').val());
		}else if(window.variables.tipo == 2){
			anularproducto(window.variables.itemid, window.variables.detalleid, $('#motivo').val());
		}
	});

	$('body').on('click','.btn_cancelaranulacion',function(event){
		event.preventDefault();
		$('.motivo').toggle();
	});

	function anularalquiler(itemid, detalleid, motivo)
	{
		if(motivo == '')
		{
			alert('Ingrese Motivo');
			return false;
		}
		$.ajax({
			url: '/anularalquiler',
			type: 'POST',
			dataType: 'json',
			data: {itemid: itemid, detalleid:detalleid, motivo:motivo,pedido_id: $('#datos').attr('data-pedidoid')},
		})
		.done(function(data) {
			if (data['estado']== true) {
				alert(data['msg']);
				window.location.href = "/caja/habitacion-order/"+$('#datos').attr('data-id');
			}else{
				alert('Operacion No completada');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

	function anularproducto(itemid, detalleid, motivo)
	{
		if(motivo == '')
		{
			alert('Ingrese Motivo');
			return false;
		}
		$.ajax({
			url: '/anularproducto',
			type: 'POST',
			dataType: 'json',
			data: {itemid: itemid, detalleid:detalleid, motivo:motivo,pedido_id: $('#datos').attr('data-pedidoid')},
		})
		.done(function(data) {
			if (data['estado'] == true) {
				alert(data['msg']);
				window.location.href = "/caja/habitacion-order/"+$('#datos').attr('data-id');
			}else{
				alert('Operacion No completada');
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

	function control(){
		var habitaciones = window.collections.habitaciones.toJSON();

		for (var i in habitaciones) {
			var flagpedido = habitaciones[i].pedidos.length;
			if (flagpedido > 0) {
				$.ajax({
					url: '/controlhabitacion',
					type: 'POST',
					dataType: 'json',
					data: {pedido_id: habitaciones[i].pedidos[0].id},
				})
				.done(function(data) {
					console.log(data);
				});
			}
		}
	}

    $('.cobrar_deuda').on('click',function(event){
        event.preventDefault();
        var id = $(this).attr('data-id');
        var r=confirm("Desea Cobrar");
        if (r==true)
        {
            window.location.href = "/caja/cobrar-deuda/"+id;
        }
        else
        {
            return false;
        }
    });
	control();
	setInterval(control,6000);
    var fecha;
    $("#datepicker").datepicker({
        format: "yyyy-m-d",
        selected:function(dateString, dateObject) {
            fecha =dateString;
        }
    });

    $('.btn_reportes').on('click', function(event){
        event.preventDefault();
        window.location.href = "/reportes/listar-reportes?fecha="+fecha;
    });
});
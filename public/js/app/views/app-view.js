Hotel.Views.App = Backbone.View.extend({
	events : {
		"click #agregaritem" : "additem",
		"click #crear_empresa": 'showregistro',
		"click #btn_cancelarregistro": 'cancelarregistro',
		"submit #form_empresa": 'crear_empresa',
		"click #provedor":'buscarempresa',
		"click #btn_guardarcompras": "crear_compra",
		"change #total": "importetotal",
		"click #btn_editcompra": "editcompra"
	},
	initialize : function ($el) {
		this.$el = $el;
	},
	additem : function (e) {
		e.preventDefault();
		window.variables.detallecompra = {
											preciocompra:'', 
											cantidad:'', 
											cantidadtotal:'', 
											preciototal:'', 
											preciounitario:'', 
											presentacion:'', 
											producto_id:'',
											unidadmedida:'',
											productonombre: ''
										};
		var model = new Hotel.Models.Detallecompra(window.variables.detallecompra);
		window.collections.detallecompra.add(model);
		model.save();
		window.variables.detallecompra = {};
	},
	showregistro: function(e){
		e.preventDefault();
		$('#form_empresa input').val('');
		$('#form_empresa .primary').val('Guardar')
		$('#form_empresa').toggle();
	},
	cancelarregistro:function(e){
		e.preventDefault();
		$('#form_empresa input').val('');
		$('#form_empresa').toggle();
	},
	crear_empresa: function(e){
		e.preventDefault();
		var objeto = $(e.currentTarget);
		console.log($(objeto).serialize());
		$.ajax({
			url: '/crear_empresa',
			type: 'POST',
			dataType: 'json',
			data: $(objeto).serialize(),
		})
		.done(function(data) {
			$('#form_empresa input').val('');
			$('#form_empresa').toggle(razonsocial);
			$('#provedor').val(data.razonsocial);
			$('#provedor_id').val(data.id);
			window.variables.idprovedor = data.id;
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	},
	buscarempresa:function(e){
		var objeto = $(e.currentTarget);
		$(objeto).autocomplete({
            source: function( request, response ) {
	            $.ajax({
	                type: "GET",
	                url: "/empresas",
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
			                        return {
			                        label: item.razonsocial,
			                        value: item.razonsocial,
			                        id:item.id,
			                        }
	            			}));
	                      }
	            });
            },
            minLength: 3,
            select: function( event, ui ) {
				window.variables.idprovedor = ui.item.id;
            }
	    });
	},
	crear_compra: function(e){
		e.preventDefault();
		var precioitems = window.collections.detallecompra.sumaprecio();
		if(Number($('#total').val()) == 0){
			return false;
		}
		if(Number(precioitems) != Number($('#total').val())){
			alert('El precio total de los detalles no es igual al importe total de la compra');
			return false;
		}
		this.subtotales();
		$.ajax({
			url: '/compras/create',
			type: 'POST',
			dataType: 'json',
			data: {
				tipocomprobante_id: $('#tipocomprobante_id').val(),
				serie: $('#serie').val(),
				numero: $('#numero').val(),
				total: $('#total').val(),
				provedor_id: window.variables.idprovedor,
				subtotal: $('#subtotal').val(),
				igv: $('#igv').val(),
				productos: window.collections.detallecompra.toJSON()
			},
		})
		.done(function(data) {
			if (data.estado)
			{
				alert(data.msg);
				window.location.href = "/compras";
			}
			else
			{
				alert(data.msg);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	},
	importetotal: function (e){
		var objeto = $(e.currentTarget);
		var itotal = Number($(objeto).val());
		$(objeto).val(itotal.toFixed(2));
		this.subtotales();
	},
	subtotales: function(){
		var subtotal = Number($('#total').val()) / 1.18;
		var igv = Number($('#total').val()) - subtotal;
		$('#subtotal').val(subtotal.toFixed(2));
		$('#igv').val(igv.toFixed(2));
	},
	editcompra: function(e){
		e.preventDefault();
		var precioitems = window.collections.detallecompra.sumaprecio();
		if(Number($('#total').val()) == 0){
			return false;
		}
		if(Number(precioitems) != Number($('#total').val())){
			alert('El precio total de los detalles no es igual al importe total de la compra');
			return false;
		}
		this.subtotales();
		$.ajax({
			url: '/compras/edit',
			type: 'POST',
			dataType: 'json',
			data: {
				tipocomprobante_id: $('#tipocomprobante_id').val(),
				serie: $('#serie').val(),
				numero: $('#numero').val(),
				total: $('#total').val(),
				provedor_id: window.variables.idprovedor,
				subtotal: $('#subtotal').val(),
				igv: $('#igv').val(),
				compra_id: $('#compra_id').val(),
				productos: window.collections.detallecompra.toJSON()
			},
		})
		.done(function(data) {
			if (data.estado)
			{
				alert(data.msg);
				window.location.href = "/compras";
			}
			else
			{
				alert(data.msg);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
});
Hotel.Views.AppOrdenes = Backbone.View.extend({
	events : {
		"click .tile" : "agregarcesta",
		"click .ordenar": "ordenar",
		"click .cobrar":"showcobrar",
		"click .cancelarcobro":"hidecobrar",
		"click .btn_ventadirecta": "cobrarventadirecta"
	},
	initialize : function ($el) {
		this.$el = $el;
	},
	agregarcesta: function(e){
		e.preventDefault();
		var objeto = e.currentTarget;
		var producto_id = $(objeto).attr('data-id');
		var producto = window.collections.productos.findWhere({id: producto_id});
		var data = {
					precio:producto.get('precioventa'), 
					cantidad:1, 
					producto_id:producto.get('id'),  
					nombre:producto.get('alias'),
					preciounitario: producto.get('precioventa')
				};
		var model = new Hotel.Models.ProductoCesta(data);
		window.collections.productoscesta.add(model);
		model.save();
	},
	ordenar: function(e){
		e.preventDefault();
		if(window.collections.productoscesta.length > 0){
			$.ajax({
				url: '/ordenarproductos',
				type: 'POST',
				dataType: 'json',
				data: {productos: window.collections.productoscesta.toJSON(),
						habitacion_id: $('#datos').attr('data-id'),
						pedido_id: $('#datos').attr('data-pedidoid')}
			})
			.done(function(data) {
				console.log("success");
				if (data['estado']) {
					alert(data['msg']);
					window.location.href = "/caja/habitacion-order/"+$('#datos').attr('data-id');
				}else{
					alert('Operacion no Completada');
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}else{
			alert('No Has agregado productos');
			return false;
		}
	},
	showcobrar:function(e){
		e.preventDefault();
		$('.cobrar').toggle();
		$('#form_cobrar').toggle();
	},
	hidecobrar:function(e){
		e.preventDefault();
		$('.cobrar').toggle();
		$('#form_cobrar').toggle();
	},
	cobrarventadirecta: function(e){
		e.preventDefault();
		if(window.collections.productoscesta.length > 0){
			$.ajax({
				url: '/caja/ventadirecta',
				type: 'POST',
				dataType: 'json',
				data: {productos: window.collections.productoscesta.toJSON()}
			})
			.done(function(data) {
				console.log("success");
				if (data['estado']) {
					alert(data['msg']);
					window.location.href = "/caja";
				}else{
					alert('Operacion no Completada');
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}else{
			alert('No Has agregado productos');
			return false;
		}
	}
});
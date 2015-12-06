Hotel.Views.ProductoCesta = Backbone.View.extend({
	events : {
		"click .danger":'eliminar',
		"change .cantidad":'modifiedcant',
		"change .preciototal":'modifiedprecio'
	},
	tagName : "tr",
	initialize : function () {
		var self = this;
		this.template = _.template($('#productocesta-template').html());
		this.model.on('change', function () {
				self.render();
		});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html(html);
	},
	eliminar: function(e){
		e.preventDefault();
		this.model.destroy();
		this.$el.remove();
		var newtotal = window.collections.productoscesta.sumaprecio();
		$('.sumaprecios').text(newtotal);
	},
	modifiedcant: function(e){
		var objeto = e.currentTarget;
		var newcantidad = $(objeto).val();
		var newprecio = parseFloat(this.model.get('preciounitario')) * parseInt(newcantidad);
		this.model.set('cantidad', newcantidad);
		this.model.set('precio', newprecio.toFixed(2));
		var newtotal = window.collections.productoscesta.sumaprecio();
		$('.sumaprecios').text(newtotal);
	},
	modifiedprecio: function (e) {
		var objeto = e.currentTarget;
		var newprecio = parseFloat($(objeto).val());
		this.model.set('precio', newprecio.toFixed(2));
		var newtotal = window.collections.productoscesta.sumaprecio();
		$('.sumaprecios').text(newtotal);
	}
});
Hotel.Views.Habitacion = Backbone.View.extend({
	events : {
		"click":'navigate',
	},
	tagName : "div",
	className:"tile bg-blue",
	initialize : function () {
		var self = this;
		this.template = _.template($('#habitacion-template').html());

		this.model.on('change', function () {
				self.render();
		});

		window.routers.base.on('route:root', function () {
			self.$el.css('display', '');
			self.render();
		});

		window.routers.base.on('route:tipohabitacion', function () {
			if(window.app.tipohabitacion == self.model.get('tipohabitacion_id') ){
				self.$el.show();
			}else{
				self.$el.hide();
			}
		});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html(html);
		if (this.model.get('estado') == 'Ocupada') {
			this.$el.removeClass('bg-blue');
			var pedido = this.model.get('pedidos');
            var alquiler = pedido[0].alquiler.length;
            var productos = pedido[0].productos.length;
            var total = Number(alquiler) + Number(productos);
            if (total == 0) {
            	this.$el.addClass('bg-green');
            }else{
            	this.$el.addClass('bg-red');
            }
        }else if (this.model.get('estado') == 'Limpieza') {
        	this.$el.removeClass('bg-blue');
        	this.$el.addClass('bg-yellow');
        }else if(this.model.get('estado') == 'Reservada'){
        	this.$el.removeClass('bg-blue');
        	this.$el.addClass('bg-amber');
        }else if(this.model.get('estado') == 'Sucia'){
            this.$el.removeClass('bg-blue');
            this.$el.addClass('bg-darkIndigo');
        }
	},
	navigate: function(){
		window.location.href = "/caja/habitacion-order/"+this.model.get('id');
	}
});
Hotel.Views.Piso = Backbone.View.extend({
	events : {
		"click":'filtrar',
	},
	tagName : "button",
	initialize : function () {
		var self = this;
		this.template = _.template($('#piso-template').html());
		self.$('.producto').focus();
		this.model.on('destroy', function () {
			self.$el.remove();
		});
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html(html);
	},
	buscarproducto: function(e){
		var objeto = $(e.currentTarget);
		var self = this;
		$(objeto).autocomplete({
            source: function( request, response ) {
	            $.ajax({
	                type: "GET",
	                url: "/productos/buscarproductos",
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
			                        label: item.nombre,
			                        value: item.nombre,
			                        id:item.id,
			                        alias: item.alias
			                        }
	            			}));
	                      }
	            });
            },
            minLength: 3,
            select: function( event, ui ) {
            	var producto_id = ui.item.id;
            	var detalle = JSON.stringify(window.collections.detallecompra.findWhere({id: producto_id}));
            	if (detalle) {
            		alert('Ya has ingresado este producto, por favor seleciona otro');
            		return false;
            	}
            	self.model.set('producto_id', ui.item.id);
            	self.model.set('productonombre', ui.item.value);
            	self.model.set('unidadmedida', ui.item.alias);
            }
	    });
	},
	presentacionedit: function(e){
		var objeto = $(e.currentTarget);
		var self = this;
		self.model.set('presentacion', $(objeto).val());
		this.costototal();
		self.model.save();
	},
	cantidadnedit: function(e){
		var objeto = $(e.currentTarget);
		var self = this;
		self.model.set('cantidad', $(objeto).val());
		this.costototal();
		self.model.save();
	},
	preciounitarioedit: function(e){
		var objeto = $(e.currentTarget);
		var self = this;
		self.model.set('preciounitario', $(objeto).val());
		this.costototal();
		self.model.save();
	},
	costototal:function(){
		var cantidadtotal = Number(this.model.get('presentacion')) *
						Number(this.model.get('cantidad'));
		var preciototal = Number(this.model.get('cantidad')) * Number(this.model.get('preciounitario'));
		var preciocompra = preciototal / cantidadtotal;
		this.model.set('preciocompra', preciocompra.toFixed(2));
		this.model.set('cantidadtotal', cantidadtotal.toFixed(2));
		this.model.set('preciototal',preciototal.toFixed(2));
		this.model.save();
	},
	guardar:function(e){
		e.preventDefault();
		this.render();
	},
	eliminar:function(e){
		e.preventDefault();
		this.model.destroy();
	},
	editar:function(e){
		this.renderedit();
	}
});
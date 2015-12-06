Hotel.Models.Detallecompra = Backbone.Model.extend({
	defaults: function () {
            return {
                preciocompra:'', 
				cantidad:'', 
				cantidadtotal:'', 
				preciototal:'', 
				preciounitario:'', 
				presentacion:'', 
				producto_id:'',
				productonombre: ''
            }
        }
});
Hotel.Models.ProductoCesta = Backbone.Model.extend({
	defaults: function () {
            return {
				precio:'', 
				cantidad:'', 
				producto_id:'',  
				nombre:'',
				preciounitario: ''
            }
        }
});
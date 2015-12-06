Hotel.Collections.ProductosCesta = Backbone.Collection.extend({
	model : Hotel.Models.ProductoCesta,
	localStorage: new Backbone.LocalStorage("productoscesta-backbone"),
	sumaprecio: function(){
		return this.reduce(function(suma, value) { return suma + Number(value.get("precio")) }, 0).toFixed(2);
	}
});
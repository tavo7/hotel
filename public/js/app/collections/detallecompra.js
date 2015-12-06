Hotel.Collections.Detallecompra = Backbone.Collection.extend({
	model : Hotel.Models.Detallecompra,
	localStorage: new Backbone.LocalStorage("detallecompra-backbone"),
	sumaprecio: function(){
		return this.reduce(function(suma, value) { return suma + Number(value.get("preciototal")) }, 0).toFixed(2);
	}
});
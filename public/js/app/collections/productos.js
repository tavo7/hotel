Hotel.Collections.Productos = Backbone.Collection.extend({
	model : Hotel.Models.Producto,
	url : '/productos/producto',
	name: 'productos'
});
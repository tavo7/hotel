Hotel.Collections.Pisos = Backbone.Collection.extend({
	model : Hotel.Models.Piso,
	url : '/pisos/piso',
	name: 'pisos'
});
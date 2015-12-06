Hotel.Collections.TiposHabitacion = Backbone.Collection.extend({
	model: Hotel.Models.TipoHabitacion,
	url: '/tiposhabitacion/tipo-habitacion',
	name: 'tiposhabitacion'
});
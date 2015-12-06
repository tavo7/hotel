Hotel.Views.TipoHabitacion = Backbone.View.extend({
	events : {
		"click":'navigate',
	},
	tagName : "button",
	initialize : function () {
		var self = this;
		this.template = _.template($('#tipohabitacion-template').html());
	},
	render : function () {
		var data = this.model.toJSON();
		// junto data con el template;
		var html = this.template(data);
		this.$el.html(html);
	},
	navigate: function(){
		Backbone.history.navigate('tipohabitacion/'+this.model.get('id'), {trigger: true});
	}
});
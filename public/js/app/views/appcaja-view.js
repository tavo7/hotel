Hotel.Views.AppCaja = Backbone.View.extend({
	events : {
		"click .all-habitaciones" : "navigate",
	},
	initialize : function ($el) {
		this.$el = $el;
	},
	navigate: function(){
		Backbone.history.navigate('', {trigger: true});
	}

});
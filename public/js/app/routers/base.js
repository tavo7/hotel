Hotel.Routers.Base = Backbone.Router.extend({
	routes : {
		"":"root",
		"tipohabitacion/:id": "tipohabitacion"
	},
	root : function () {
		window.app.state = "root";
	},
	tipohabitacion: function(id){
		window.app.state = "tipohabitacion";
		window.app.tipohabitacion =  id;
	}
});
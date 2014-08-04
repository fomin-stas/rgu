var App = {
	options: {
		baseURL:'',
		userId:0,
	},

	init: function(_options){
		App.options.baseURL = _options.baseURL;
		switch(_options.page){
			case 'site/login':
				App.initLogin();
				break;
			case 'structure/arm_kis':
				Structure.init();
				break;	
			default:
				return null;
				break;	
		}
	},

	initLogin: function(){
		console.log('login');	
	},

}
jQuery(document).ready(function($) {
	App.init(_options);	
});
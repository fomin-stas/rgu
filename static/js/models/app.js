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
				Structure.initKIS();
				break;
			case 'structure/arm_iogv':
				Structure.initIOGV();
				break;	
			case 'settings/index':
				Settings.initIndex();
				break;	
			case 'structure/uvedoml':
				Structure.initNotifications();
				break;	
			default:
				return null;
				break;	
		}
	},

	initLogin: function(){
		console.log('login');	
	},

	linkToStep:function(cellvalue, options, rowObject){
		switch(rowObject.id_authority_status) {
			case '1':
				text_link = 'structure/step2/'+rowObject.id_authority;
				break;
			case '2':
				text_link = 'structure/step3/'+rowObject.id_authority;	
				break;
			case '3':
				text_link = 'structure/step4/'+rowObject.id_authority;
				break;		
		}

        cellvalue=cellvalue.link(text_link);
        return cellvalue;
	},

	unLinkToStep:function (cellvalue, options, rowObject)
                    {
                        var a_tag = "<a href='"+text_link+"'>";
                        //cellvalue = cellvalue.replace(a_tag,"");
                        return cellvalue;
                    },
    send: function (action, method, input) {
		'use strict';
		var form;
		form = $('<form />', {
		    action: action,
		    method: method,
		    style: 'display: none;'
		});
		if (typeof input !== 'undefined' && input !== null) {
		    $.each(input, function (name, value) {
		        $('<input />', {
		            type: 'hidden',
		            name: name,
		            value: value
		        }).appendTo(form);
		    });
		}
		form.appendTo('body').submit();
	}                

}
jQuery(document).ready(function($) {
	App.init(_options);	
});
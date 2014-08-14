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

	linkToStep:function(cellvalue, options, rowObject){
		if(options.rowId==1) //this is not good
        {
            text_link="structure/step3";
        }
        else {text_link="structure/step4_1";}
        cellvalue=cellvalue.link(text_link);
        return cellvalue;
	},

	unLinkToStep:function (cellvalue, options, rowObject)
                    {
                        var a_tag = "<a href='"+text_link+"'>";
                        //cellvalue = cellvalue.replace(a_tag,"");
                        return cellvalue;
                    }

}
jQuery(document).ready(function($) {
	App.init(_options);	
});
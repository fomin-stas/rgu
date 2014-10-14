(function( $ ){
    $.fn.checkbox = function( options ) {

        // Create some defaults, extending them with any options that were provided
        var settings = $.extend( {
            'delete_button'         : '.delete_selected',
            'select_all' : 'SelectAll',
            'delete_closure' : function(param){},
            'excluded_click' : ['#actions']
        }, options);
        function toggle_delete_button(){
            if($('tr input[type="checkbox"]:checked').length > 0){
                $(settings.delete_button).removeClass('disabled');
            }else{
                $(settings.delete_button).addClass('disabled');
            }
        }
        $('tr input[type="checkbox"]:not(#'+settings.select_all+')').click(function(){
            var state = $(this).attr('checked');
            if(typeof state != "undefined"){//reverse hack for td click
                state = null;
            }else{
                state = 'checked';
            }
            $(this).attr('checked', state);
            toggle_delete_button();
        });
        for (var i in settings.excluded_click){
            $('td:not('+settings.excluded_click[i]+')').click(function(){
                var $this = $('input[type="checkbox"]', $(this).parent());
                if(typeof $this.attr('checked') != "undefined"){
                    $this.attr('checked', null);
                }else{
                    $this.attr('checked', 'checked');
                }
                toggle_delete_button();
            });
        }
        $(settings.delete_button).click(function(){
            var selected = new Array();
            $('tr input[type="checkbox"]').each(function(index, elem){
                if(typeof $(elem).attr('checked') != "undefined"
                    && $(elem).attr('id') != settings.select_all){
                    selected.push($(elem).attr('id'));
                }
            });
            if(selected.length > 0){
                selected = selected.join();
                settings.delete_closure(selected);
            }
        });
        $('#'+settings.select_all).click(function(){
            var state = $(this).attr('checked');
            if(typeof state == "undefined") state = null;
            $('tr input[type="checkbox"]').each(function(){
                $(this).attr('checked', state);
            });
            toggle_delete_button();
        });
        return this;
    };
})( jQuery );
    
    $().checkbox({delete_closure : function(selected){
        $('#postvalue').attr('value',selected);
    }})
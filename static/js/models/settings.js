var Settings = {
	options: {
		data:''
	},

	initIndex: function(){
		console.log('initIndex');
        // open modal by URL.hash
        if(window.location.hash) {
          var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
          switch(hash){
            case 'add_property':
                $('#add_property').modal();
                break;
            case 'edit_property':
                $('#edit_property').modal();
                break;    
            default:
                return null;
                break;  
          }
        }

        // remove row on Properties table
        $('#properties-table .a-remove').on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm("Вы действительно хотите удалить свойство с id " + id)){
                $.ajax({
                        url: App.options.baseURL+'ajax/remove_property',
                        type: 'post',
                        data: {id: id},
                        dataType: 'json',
                        success: function (data) {
                            if(data.success) {
                                $('#property_'+id).fadeOut('normal', function(){ $(this).remove();});
                            }
                        }
                    });

            }
        });


        // edit row on Properties table
        $('#properties-table .a-edit').on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                    url: App.options.baseURL+'ajax/get_property_by_id',
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        if(data.success) {
                            var p = data.property;
                            console.log(p);
                            // load data to modal
                            $('#edit_property_name').val(p.property_name)
                            $('#edit_property_short_name').val(p.property_short_name)
                            $('#edit_property_type').val(p.id_property_type);
                            $('#edit_property_align').val(p.options.property_align);
                            $('#edit_property_width').val(p.options.property_width);
                            if(p.options.property_required == "on") {
                                $('#edit_property_required').prop('checked', true);
                            } 
                            else{
                                $('#edit_property_required').prop('checked', false);
                            }
                            $('#edit_property_color').val(p.options.property_color).iris('color', p.options.property_color);
                            $('#edit_service_type').val(p.id_service_type);
                            $('#edit_id_property').val(p.id_property);
                            $('#edit_property').modal();
                        }
                    }
                });

        });

        // init Color piker
        $('#add_property_color, #edit_property_color').iris({
            hide: true,
            palettes: ['#125', '#459', '#78b', '#ab0', '#de3', '#f0f']
        });
	},

}

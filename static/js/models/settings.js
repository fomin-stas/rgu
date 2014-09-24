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

        // if property type == select => show select values box
        $('#add_property_type').on('change', function(e){
            if($(this).val() == 3){
                $('#add_type_values_row').show();
            }
            else{
                $('#add_type_values_row').hide();   
            }
        });

        // if property type == select => show select values box
        $('#edit_property_type').on('change', function(e){
            if($(this).val() == 3){
                $('#edit_type_values_row').show();
            }
            else{
                $('#edit_type_values_row').hide();   
            }
        });

        // add new values for property with select type
        $('#add_type_values_btn').on('click', function(e){
            e.preventDefault();
            var elem = $('#add_type_values'),
                value = $(elem).val(),
                html = '<span class="label label-success"><input type="hidden" name="type_values[]" value="'+value+'">'+value+' <a href="#" class="a-value-remove">x</a></span>';
            if(value.length > 0) {
                $('#add_type_values_list').append(html);    
            }    
            $(elem).val('');
        });

        $('#add_type_values_list').on('click', '.a-value-remove', function(e){
            e.preventDefault();
            $(this).parent('.label').remove();
        });

        // add new values for property with select type
        $('#edit_type_values_btn').on('click', function(e){
            e.preventDefault();
            var elem = $('#edit_type_values'),
                value = $(elem).val(),
                html = '<span class="label label-success"><input type="hidden" name="type_values[]" value="'+value+'">'+value+' <a href="#" class="a-value-remove">x</a></span>';
            if(value.length > 0) {
                $('#edit_type_values_list').append(html);    
            }    
            $(elem).val('');
        });

        $('#edit_type_values_list').on('click', '.a-value-remove', function(e){
            e.preventDefault();
            var elem = $(this), 
                property_id = $(elem).data('property-value-id');
            if(confirm('Вы действительно хотите удалить свойство?')) {
                $.ajax({
                    url: App.options.baseURL+'ajax/delete_property_by_id',
                    type: 'post',
                    data: {property_id: property_id},
                    dataType: 'json',
                    success: function (data) {
                        if(data.success) {
                            $(elem).parent('.label').remove();
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
                            console.log(data);
                            var p = data.property;
                            // load data to modal
                            $('#edit_property_name').val(p.property_name)
                            $('#edit_property_short_name').val(p.property_short_name)
                            $('#edit_property_type').val(p.id_property_type);
                            
                            // check property tupe == select
                            if(p.id_property_type == 3){
                                $('#edit_type_values_row').show();

                                var values_html = '';
                                if(p.values.length > 0) {
                                    for (var i = p.values.length - 1; i >= 0; i--) {
                                        console.log(p.values[i]);
                                        values_html += '<span class="label label-success">'+p.values[i].value+' <a href="#" class="a-value-remove" data-property-value-id="'+p.values[i].property_value_id+'">x</a></span>';
                                    };
                                    if(values_html.length > 0) {
                                        $('#edit_type_values_list').html(values_html);
                                    }
                                }
                            }
                            else{
                                $('#edit_type_values_row').hide();
                            }

                            if(p.options != null) {
                                $('#edit_property_align').val(p.options.property_align);
                                $('#edit_property_width').val(p.options.property_width);

                                // Property required?
                                if(p.options.property_required == "on") {
                                    $('#edit_property_required').prop('checked', true);
                                } 
                                else{
                                    $('#edit_property_required').prop('checked', false);
                                }

                                // Show property from other users
                                if(p.options.property_show_other_users == "on") {
                                    $('#edit_property_show_other_users').prop('checked', true);
                                } 
                                else{
                                    $('#edit_property_show_other_users').prop('checked', false);
                                }
                                $('#edit_property_color').val(p.options.property_color).iris('color', p.options.property_color);
                            }
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

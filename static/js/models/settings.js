var Settings = {
    options: {
        data: ''
    },
    initIndex: function() {
        //alternativ select

        // open modal by URL.hash
        if (window.location.hash) {
            var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
            switch (hash) {
                case 'add_property':
                    $('#add_property').modal();
                    break;
                case 'edit_property':
                    $('#edit_property').modal();
                    break;
                case 'edit_additional_property':
                    $('#edit_additional_property').modal();
                default:
                    return null;
                    break;
            }
        }

        // remove row on Properties table
        $('#properties-table .a-remove').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (confirm("Вы действительно хотите удалить свойство с id " + id)) {
                $.ajax({
                    url: App.options.baseURL + 'ajax/remove_property',
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $('#property_' + id).fadeOut('normal', function() {
                                $(this).remove();
                            });
                        }
                    }
                });

            }
        });

        function init_property_modals(name, is_edit) {
            // if property type == select => show select values box
            $('#' + name + '_property_type').on('change', function(e) {
                if ($(this).val() == 3) {
                    $('#' + name + '_type_values_row').show();
                }
                else {
                    $('#' + name + '_type_values_row').hide();
                }
            });

            $('#' + name + '_parent_type').on('change', function(e) {
                switch ($(this).val()) {
                    case 'property':
                        $('#' + name + '_parent_property').show(function() {
                            $('#' + name + '_parent_property_list').chosen();
                        });
                        $('#' + name + '_parent_property_values').hide();
                        $('#' + name + '_parent_additional_property').hide();
                        $('#' + name + '_parent_additional_property_values').hide();
                        break;
                    case 'property_values':
                        $('#' + name + '_parent_property').hide();
                        $('#' + name + '_parent_property_values').show(function() {
                            $('#' + name + '_parent_property_values_list').chosen();
                        });
                        $('#' + name + '_parent_additional_property').hide();
                        $('#' + name + '_parent_additional_property_values').hide();
                        break;
                    case 'additional_property':
                        $('#' + name + '_parent_property').hide();
                        $('#' + name + '_parent_property_values').hide();
                        $('#' + name + '_parent_additional_property').show(function() {
                            $('#' + name + '_parent_additional_property_list').chosen();
                        });
                        $('#' + name + '_parent_additional_property_values').hide();
                        break;
                    case 'additional_property_values':
                        $('#' + name + '_parent_property').hide();
                        $('#' + name + '_parent_property_values').hide();
                        $('#' + name + '_parent_additional_property').hide();
                        $('#' + name + '_parent_additional_property_values').show(function() {
                            $('#' + name + '_parent_additional_property_values_list').chosen();
                        });
                        break;
                }
            });

            $('#' + name + '_parent_property_values_list').on('change', function(e) {
                var id = $(this).val();
                var elem = $(this);
                $.ajax({
                    url: App.options.baseURL + 'ajax/get_property_values/' + id + "/" + name,
                    dataType: 'json',
                    success: function(data) {
                        $('#' + name + '_parent_property_value_group').html(data.inner_html);
                    }
                });
            });

            $('#' + name + '_parent_additional_property_values_list').on('change', function(e) {
                var id = $(this).val();
                var elem = $(this);
                $.ajax({
                    url: App.options.baseURL + 'ajax/get_additional_property_values/' + id + "/" + name,
                    dataType: 'json',
                    success: function(data) {
                        $('#' + name + '_parent_additional_property_value_group').html(data.inner_html);
                    }
                });
            });

            // add new values for property with select type
            $('#' + name + '_type_values_btn').on('click', function(e) {
                e.preventDefault();
                var elem = $('#' + name + '_type_values'),
                        value = $(elem).val(),
                        html = '<span class="label label-success"><input type="hidden" name="type_values[]" value="' + value + '">' + value + ' <a href="#" class="a-value-remove">x</a></span>';
                if (value.length > 0) {
                    $('#' + name + '_type_values_list').append(html);
                }
                $(elem).val('');
            });

            if (!is_edit) {
                $('#' + name + '_type_values_list').on('click', '.a-value-remove', function(e) {
                    e.preventDefault();
                    $(this).parent('.label').remove();
                });
            }
            // init Color piker
            $('#add_property_color, #edit_property_color').iris({
                hide: true,
                palettes: ['#125', '#459', '#78b', '#ab0', '#de3', '#f0f']
            });
        }
        init_property_modals('add_additional', false);
        init_property_modals('add', false);
        init_property_modals('edit', true);
        init_property_modals('edit_additional', true);

        $('#edit_type_values_list').on('click', '.a-value-remove', function(e) {
            e.preventDefault();
            var elem = $(this),
                    property_id = $(elem).data('property-value-id');
            if (confirm('Вы действительно хотите удалить свойство?')) {
                $.ajax({
                    url: App.options.baseURL + 'ajax/delete_property_by_id',
                    type: 'post',
                    data: {property_id: property_id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            $(elem).parent('.label').remove();
                        }
                    }
                });
            }
        });

        $('#edit_additional_type_values_list').on('click', '.a-value-remove', function(e) {
            e.preventDefault();
            var elem = $(this),
                    property_id = $(elem).data('property-value-id');
            if (confirm('Вы действительно хотите удалить свойство?')) {
                $(elem).parent('.label').remove();
            }
        });

        // set display value when we are create new property
        $('#add_property_iogv_displayed').on('change', function() {
            if ($(this).is(':checked')) {
                $('#add_property_required_box').show();
                $('#add_property_other_users_displayed_box').hide();
            }
            else {
                $('#add_property_required_box').hide();
                $('#add_property_other_users_displayed_box').show();
            }
        });

        // edit row on Properties table
        $('#properties-table .a-edit').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: App.options.baseURL + 'ajax/get_property_by_id',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        var p = data.property;
                        // load data to modal
                        $('#edit_property_name').val(p.property_name)
                        $('#edit_property_short_name').val(p.property_short_name)
                        $('#edit_property_type').val(p.id_property_type);
                        // check property tupe == select
                        if (p.id_property_type == 3) {
                            $('#edit_type_values_row').show();

                            var values_html = '';
                            if (p.values.length > 0) {
                                for (var i = p.values.length - 1; i >= 0; i--) {
                                    values_html += '<span class="label label-success">' + p.values[i].value + ' <a href="#" class="a-value-remove" data-property-value-id="' + p.values[i].property_value_id + '">x</a></span>';
                                }
                                ;
                                if (values_html.length > 0) {
                                    $('#edit_type_values_list').html(values_html);
                                }
                            }
                        }
                        else {
                            $('#edit_type_values_row').hide();
                        }

                        if (p.options != null) {
                            $('#edit_property_align').val(p.options.property_align);
                            $('#edit_property_width').val(p.options.property_width);

                            // Property required?
                            if (p.options.property_required == "on") {
                                $('#edit_property_required').prop('checked', true);
                            }
                            else {
                                $('#edit_property_required').prop('checked', false);
                            }

                            // Show property from other users
                            if (p.options.property_show_other_users == "on") {
                                $('#edit_property_show_other_users').prop('checked', true);
                            }
                            else {
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

        $('#additional_properties_table .a-edit').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: App.options.baseURL + 'ajax/get_additional_property/' + id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        var p = data.property;
                        // load data to modal
                        $('#edit_additional_property_name').val(p.additional_property_name)

                        $('#edit_additional_property_type').val(p.id_property_format);
                        // check property tupe == select
                        if (p.id_property_format == 3) {
                            $('#edit_additional_type_values_row').show();

                            var values_html = '';
                            if (p.values.length > 0) {
                                for (var i = p.values.length - 1; i >= 0; i--) {
                                    values_html += '<span class="label label-success"><input type="hidden" name="type_values[]" value="' + p.values[i].value + '">' + p.values[i].value + ' <a href="#" class="a-value-remove" data-property-value-id="' + p.values[i].property_value_id + '">x</a></span>';
                                }
                                ;
                                if (values_html.length > 0) {
                                    $('#edit_additional_type_values_list').html(values_html);
                                }
                            }
                        }
                        else {
                            $('#edit_additional_type_values_row').hide();
                        }
                        $('#edit_additional_id_additional_property').val(p.id_additional_property);
                        $('#edit_additional_parent_type').val(data.parent);
                        switch (data.parent) {
                            case 'property':
                                $('#edit_additional_parent_property_list').val(data.id_parent);
                                $('#edit_additional_parent_property').show();
                                $('#edit_additional_parent_property_values').hide();
                                $('#edit_additional_parent_additional_property').hide();
                                $('#edit_additional_parent_additional_property_values').hide();
                                break;
                            case 'additional_property':
                                $('#edit_additional_parent_additional_property').val(data.id_parent);
                                $('#edit_additional_parent_property').hide();
                                $('#edit_additional_parent_property_values').hide();
                                $('#edit_additional_parent_additional_property').show();
                                $('#edit_additional_parent_additional_property_values').hide();
                                break;
                            case 'property_values':
                                $('#edit_additional_parent_property_values_list').val(data.id_property);
                                $('#edit_additional_parent_property').hide();
                                $('#edit_additional_parent_property_values').show();
                                $('#edit_additional_parent_additional_property').hide();
                                $('#edit_additional_parent_additional_property_values').hide();
                                $('#edit_additional_parent_property_value_group').html(data.inner_html);
                                //$("#edit_additional_parent_property_value").chosen();
                                break;
                            case 'additional_property_values':
                                $('#edit_additional_parent_additional_property_values').val(data.id_property);
                                $('#edit_additional_parent_property').hide();
                                $('#edit_additional_parent_property_values').hide();
                                $('#edit_additional_parent_additional_property').hide();
                                $('#edit_additional_parent_additional_property_values').show();
                                $('#edit_additional_parent_additional_property_value_group').html(data.inner_html);
                                break;
                        }
                        $('#edit_additional_property').modal();
                    }
                }
            });

        });

//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Russian.json
        $('#additional_properties_table').DataTable({
            "oLanguage": {
                "sProcessing": "Подождите...",
                "sSearch": "Поиск:",
                "sLengthMenu": "Показать _MENU_ записей",
                "sInfo": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "sInfoEmpty": "Записи с 0 до 0 из 0 записей",
                "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
                "sInfoPostFix": "",
                "sLoadingRecords": "Загрузка записей...",
                "sZeroRecords": "Записи отсутствуют.",
                "sEmptyTable:": "В таблице отсутствуют данные",
                "oPaginate": {
                    "sFirst": "Первая",
                    "sPrevious": "Предыдущая",
                    "sNext": "Следующая",
                    "sLast": "Последняя"
                },
                "oAria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            }
        });
        $('.dd').nestable();
        $('.dd-handle a').on('mousedown', function (e) {
            e.stopPropagation();
        });
        $('.dd').on('change', function() {
            var ordering = $('.dd').nestable('serialize');
            $.ajax({
                    url: App.options.baseURL + 'settings/reordering',
                    type: 'post',
                    data: {order : ordering},
                    success: function(data) {
                        
                    }
                });
        });
//        $('#properties-table').DataTable({
//            "oLanguage": {
//                "sProcessing": "Подождите...",
//                "sSearch": "Поиск:",
//                "sLengthMenu": "Показать _MENU_ записей",
//                "sInfo": "Записи с _START_ до _END_ из _TOTAL_ записей",
//                "sInfoEmpty": "Записи с 0 до 0 из 0 записей",
//                "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
//                "sInfoPostFix": "",
//                "sLoadingRecords": "Загрузка записей...",
//                "sZeroRecords": "Записи отсутствуют.",
//                "sEmptyTable:": "В таблице отсутствуют данные",
//                "oPaginate": {
//                    "sFirst": "Первая",
//                    "sPrevious": "Предыдущая",
//                    "sNext": "Следующая",
//                    "sLast": "Последняя"
//                },
//                "oAria": {
//                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
//                    "sortDescending": ": активировать для сортировки столбца по убыванию"
//                }
//            }
//        });

    }

}

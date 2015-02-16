<?php if ($id_property_format == 2): ?>
    <div class="content_tree col-md-12" id="<?= $type ?>_<?= $service_num ?>_content_<?= $id_additional_property ?>">
        <label for="content_textarea_<?= $id_additional_property ?>" class=""><?= $additional_property_name ?>:</label>
        <textarea id="<?= $type ?>_<?= $service_num ?>_content_textarea_<?= $id_additional_property ?>" name="additional_<?= $type ?>_<?= $service_num ?>_content_textarea_<?= $id_additional_property ?>" class="col-md-12 form-control"><?= isset($additional_value) ? $additional_value : '' ?></textarea>
    </div>
<?php endif; ?>
<?php if ($id_property_format == 3): ?>
    <div class="content_tree col-md-9" id="<?= $type ?>_<?= $service_num ?>_content_<?= $id_additional_property ?>">
        <label for="content_select_<?= $id_additional_property ?>" class=""><?= $additional_property_name ?>:</label>
        <?= form_dropdown('additional_' . $type . '_' . $service_num . '_content_select_' . $id_additional_property, isset($options) ? $options : '', isset($additional_value) ? $additional_value : '', 'class="col-md-12 form-control dropdown" data-type="select"') ?>
    </div>
<?php endif; ?>
<?php if ($id_property_format == 4): ?>
    <div class="content_tree col-md-9" id="<?= $type ?>_<?= $service_num ?>_content_<?= $id_additional_property ?>">
        <label for="content_date_<?= $id_additional_property ?>" class=""><?= $additional_property_name ?>:</label>
        <input id="<?= $type ?>_<?= $service_num ?>_content_textarea_<?= $id_additional_property ?>" name="additional_<?= $type ?>_<?= $service_num ?>_content_textarea_<?= $id_additional_property ?>" class="col-md-12 form-control"><?= isset($additional_value) ? $additional_value : '' ?></input>
        <script>
            $('#<?= $type ?>_<?= $service_num ?>_content_textarea_<?= $id_additional_property ?>').datepicker({
                format: "dd-mm-yyyy",
                weekStart: 1,
                startDate: "-all earlier dates will be disabled",
                language: "ru",
                daysOfWeekDisabled: "0,6",
                autoclose: true,
                todayHighlight: true
            });
        </script>
    </div>
<?php endif; ?>
<?php if ($id_property_format == 7): ?>
<div class="content_tree col-md-9" id="<?= $type ?>_<?= $service_num ?>_content_<?= $id_additional_property ?>">
    <!--    <span class="col-md-10">
        <input type="file" multiple id="<?= $type ?>_<?= $service_num ?>_content_file_<?= $id_additional_property ?>" name="step_file" class="files">
    </span>-->
    <form id="<?= $type ?>_<?= $service_num ?>_content_file_<?= $id_additional_property ?>" method="post" action="ajax/upload">
        <input  type="file" name="<?= $type ?>_<?= $service_num ?>_content_file_<?= $id_additional_property ?>[]" multiple />

        <div class="hr hr-12 dotted"></div>

        <button type="submit" class="btn btn-sm btn-primary">Загрузить</button>
        <button type="reset" class="btn btn-sm">Сбросить</button>
    </form>
</div>
    <script type="text/javascript">
        jQuery(function ($) {
            var $form = $('#<?= $type ?>_<?= $service_num ?>_content_file_<?= $id_additional_property ?>');
            //you can have multiple files, or a file input with "multiple" attribute
            var file_input = $form.find('input[type=file]');
            var upload_in_progress = false;

            file_input.ace_file_input({
                style: 'well',
                btn_choose: 'Выберете или перетащите файл',
                btn_change: null,
                droppable: true,
                thumbnail: 'large',
                maxSize: 2110000, //bytes
                allowExt: ["jpeg", "jpg", "png", "gif" ,"doc" ,"docx" ,"xls" ,"xlsx" ,"zip" ,"pdf"],
                allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif" , 'application/msword' , 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ,'application/x-zip','application/pdf'],
                before_remove: function () {
                    if (upload_in_progress)
                        return false;//if we are in the middle of uploading a file, don't allow resetting file input
                    return true;
                },
                preview_error: function (filename, code) {
                    //code = 1 means file load error
                    //code = 2 image load error (possibly file is not an image)
                    //code = 3 preview failed
                }
            })
            file_input.on('file.error.ace', function (ev, info) {
                if (info.error_count['ext'] || info.error_count['mime'])
                    alert('Не поддерживаемый формат файлов');
                if (info.error_count['size'])
                    alert('Слишком большой размер! Максимальный размер 2100 КБ!');

                //you can reset previous selection on error
                //ev.preventDefault();
                //file_input.ace_file_input('reset_input');
            });


            var ie_timeout = null;//a time for old browsers uploading via iframe

            $form.on('submit', function (e) {
                e.preventDefault();

                var files = file_input.data('ace_input_files');
                if (!files || files.length == 0)
                    return false;//no files selected

                var deferred;
                if ("FormData" in window) {
                    //for modern browsers that support FormData and uploading files via ajax
                    //we can do >>> var formData_object = new FormData($form[0]);
                    //but IE10 has a problem with that and throws an exception
                    //and also browser adds and uploads all selected files, not the filtered ones.
                    //and drag&dropped files won't be uploaded as well

                    //so we change it to the following to upload only our filtered files
                    //and to bypass IE10's error
                    //and to include drag&dropped files as well
                    formData_object = new FormData();//create empty FormData object

                    //serialize our form (which excludes file inputs)
                    $.each($form.serializeArray(), function (i, item) {
                        //add them one by one to our FormData 
                        formData_object.append(item.name, item.value);
                    });
                    //and then add files
                    $form.find('input[type=file]').each(function () {
                        var field_name = $(this).attr('name');
                        //for fields with "multiple" file support, field name should be something like `myfile[]`

                        var files = $(this).data('ace_input_files');
                        if (files && files.length > 0) {
                            for (var f = 0; f < files.length; f++) {
                                formData_object.append(field_name, files[f]);
                            }
                        }
                    });


                    upload_in_progress = true;
                    file_input.ace_file_input('loading', true);

                    deferred = $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        processData: false, //important
                        contentType: false, //important
                        dataType: 'json',
                        data: formData_object
                                /**
                                 ,
                                 xhr: function() {
                                 var req = $.ajaxSettings.xhr();
                                 if (req && req.upload) {
                                 req.upload.addEventListener('progress', function(e) {
                                 if(e.lengthComputable) {	
                                 var done = e.loaded || e.position, total = e.total || e.totalSize;
                                 var percent = parseInt((done/total)*100) + '%';
                                 //percentage of uploaded file
                                 }
                                 }, false);
                                 }
                                 return req;
                                 },
                                 beforeSend : function() {
                                 },
                                 success : function() {
                                 }*/
                    })

                }
                else {
                    //for older browsers that don't support FormData and uploading files via ajax
                    //we use an iframe to upload the form(file) without leaving the page

                    deferred = new $.Deferred //create a custom deferred object

                    var temporary_iframe_id = 'temporary-iframe-' + (new Date()).getTime() + '-' + (parseInt(Math.random() * 1000));
                    var temp_iframe =
                            $('<iframe id="' + temporary_iframe_id + '" name="' + temporary_iframe_id + '" \
                                                    frameborder="0" width="0" height="0" src="about:blank"\
                                                    style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
                            .insertAfter($form)

                    $form.append('<input type="hidden" name="temporary-iframe-id" value="' + temporary_iframe_id + '" />');

                    temp_iframe.data('deferrer', deferred);
                    //we save the deferred object to the iframe and in our server side response
                    //we use "temporary-iframe-id" to access iframe and its deferred object

                    $form.attr({
                        method: 'POST',
                        enctype: 'multipart/form-data',
                        target: temporary_iframe_id //important
                    });

                    upload_in_progress = true;
                    file_input.ace_file_input('loading', true);//display an overlay with loading icon
                    $form.get(0).submit();


                    //if we don't receive a response after 30 seconds, let's declare it as failed!
                    ie_timeout = setTimeout(function () {
                        ie_timeout = null;
                        temp_iframe.attr('src', 'about:blank').remove();
                        deferred.reject({'status': 'ошибка', 'message': 'Превышено время ожедания!'});
                    }, 30000);
                }


                ////////////////////////////
                //deferred callbacks, triggered by both ajax and iframe solution
                deferred
                        .done(function (result) {//success
                            //format of `result` is optional and sent by server
                            //in this example, it's an array of multiple results for multiple uploaded files
                            var message = '';
                            for (var i = 0; i < result.length; i++) {
                                if (result[i].status == 'OK') {
                                    message += "Файл успешно загружен. Эскиз: " + result[i].url
                                }
                                else {
                                    message += "Файл не сохранен. " + result.message;
                                }
                                message += "\n";
                            }
                            alert(message);
                        })
                        .fail(function (result) {//failure
                            alert("Произошла ошибка");
                        })
                        .always(function () {//called on both success and failure
                            if (ie_timeout)
                                clearTimeout(ie_timeout)
                            ie_timeout = null;
                            upload_in_progress = false;
                            file_input.ace_file_input('загрузка', false);
                        });

                deferred.promise();
            });


            //when "reset" button of form is hit, file field will be reset, but the custom UI won't
            //so you should reset the ui on your own
            $form.on('reset', function () {
                $(this).find('input[type=file]').ace_file_input('reset_input_ui');
            });


            if (location.protocol == 'file:')
                alert("For uploading to server, you should access this page using 'http' protocal, i.e. via a webserver.");

        });
    </script>
<?php endif; ?>
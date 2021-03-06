<div class="main-container">
    <div class="container">
        <div id="my-wizard" data-target="#step-container" class="wizard">
            <ul class="wizard-steps">
                <li data-target="#step1" class="complete">
                    <span class="step">1</span>
                    <span class="title">Новое полномочие</span>
                </li>
                <li data-target="#step2" class="complete">
                    <span class="step">2</span>
                    <span class="title">Присвоение статуса полномочию</span>
                </li>
                <li data-target="#step3" class="active">
                    <span class="step">3</span>
                    <span class="title">Согласование присвоения статуса</span>
                </li>
                <li data-target="#step4">
                    <span class="step">4</span>
                    <span class="title">Полномочию присвоен статус</span>
                </li>
            </ul>
        </div>
        <hr>
        <div class="step-content" id="step-container">
            <div class="step-pane" id="step1">
                <!-- step 1-->
            </div>

            <div class="step-pane" id="step2">
                <!-- step 2-->
            </div>

            <div class="step-pane active" id="step3">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="center">Присвоение статуса полномочию</h3>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>ID полномочия:</td>
                                <td><?= $authority_id ?></td>
                            </tr>
                            <tr>
                                <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                <td><?= isset($authority_name) ? $authority_name : 'не установлено' ?></td>
                            </tr>
                            <tr>
                                <td>№ пункта в положении об ИОГВ:</td>
                                <td><?= isset($punkt_iogv) ? $punkt_iogv : 'не установлен' ?></td>
                            </tr>
                            <tr>
                                <td>Наименование ИОГВ СПб:</td>
                                <td><?= isset($name_iogv) ? $name_iogv : 'не установлен' ?></td>
                            </tr>
                            <tr>
                                <td>Срок ответа:</td>
                                <td><? if (isset($srok_otveta)) echo $srok_otveta;?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-striped table-condensed">
                            <tr>
                                <td>Ответственный орган:</td>
                                <td><?= isset($name_iogv) ? $name_iogv : 'не установлен' ?></td>
                            </tr>
                            <tr>
                                <td>Статус:</td>
                                <td><?= $id_authority_status==3?'<p style="color:green">Полномочию присвоен статус</p>':'<p id="status_text" style="color:red">Ожидает присвоения статуса полномочию</p>'?></td>
                            </tr>
                            <tr>
                                <td>Комментарий:</td>
                                <td><a href="comments/view/<?= $id_authority ?>">Читать комментарии</a></td>
                            </tr>
                            <tr>
                                <td>Приложенные файлы</td>
                                <td>
                                    <?php if (isset($files)): ?>
                                        <?php foreach ($files as $file): ?>
                                    <a href="file_storage/authority/<?= $file['file_name'] ?>"><?= $file['name'] ?></a><br>
                                        <?php endforeach; ?>
                                    <?php else: ?> 
                                        Нет прикрепленных файлов
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="widget-box">
                            <div class="widget-header">
                                <div class="widget-toolbar">
                                    <ul id="razgran_u_f_tabs" class="nav nav-tabs">
                                        <?php $service_num = 0; ?>
                                        <?php foreach ($services as $service): ?>
                                            <?php $service_num++; ?>
                                            <li <?php if ($service_num == 1) echo 'class="active"'; ?>><a href="#usl_<?= $service_num; ?>" data-toggle="tab"><?= $service['type'] . ' ' . $service_num; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-body">
                                <form name="step3_disagree_com" method="post" action="agreeds/in_work/<?= $id_authority; ?>" enctype="multipart/form-data">
                                    <div class="widget-main padding-16">
                                        <div class="tab-content">
                                            <?php $tab_num = 0; ?>
                                            <?php foreach ($services as $id_services => $service): ?>
                                                <?php $tab_num++; ?>
                                                <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>
                                                    <table class="table table-bordered">
                                                        <?php if(isset($service['properties']))foreach ($service['properties'] as $name => $value): ?>
                                                            <tr>
                                                                <td class="col-md-4"><?= $value['property_name']; ?></td>
                                                                <td class="col-md-5"><?= $value['value']; ?></td>
                                                                <td class="col-md-3" style="padding-left: 2px">
                                                                    <div class="col-sm-9" style="padding-left: 2px">
                                                                        <label>
                                                                            <input type="radio" class="ace " value="1" <?php if ($value['agreed'] == 1) echo 'checked'; ?> name="<?= $id_services . '_' . $name ?>"> 
                                                                            <span class="lbl">Согласовано</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" class="ace" value="2" <?php if ($value['agreed'] == 2) echo 'checked'; ?> name="<?= $id_services . '_' . $name ?>">
                                                                            <span class="lbl">Не просмотрено</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" class="ace" value="0" <?php if ($value['agreed'] == 0) echo 'checked'; ?> name="<?= $id_services . '_' . $name ?>">
                                                                            <span class="lbl">Не согласовано</span>
                                                                        </label>
                                                                    </div>
                                                                    <div  class=" col-sm-3" style="padding-left: 2px">
                                                                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_<?= $id_services ?>_<?= $name; ?>">
                                                                            <i class="ace-icon fa fa-comment icon-only"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="row">
                                                <span class="col-md-12">
                                                    <button type="button" class="btn <?= $id_authority_status==3?'disabled':'btn-danger'?> btn-sm pull-right saccess" id="success_sk_<?= $id_services ?>"><?= $id_authority_status==3?'Статус полномочия согласован':'Согласовать статус полномочия'?></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <span class="col-md-6">
                                                <div class="form-group pull-right">
                                                    <label for="srok_otveta" class="control-label">Срок ответа</label>
                                                    <input id="srok_otveta" type="text">
                                                </div>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="comments_modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                                    <textarea class="input-xxlarge center" name="comment_st3_disagree"></textarea>
                                                    <div class="space-6"></div>
                                                    <table class="table">
                                                        <tr>
                                                                        <td> 
                                                                            <div class="row">
                                                                                <div id="file_div">
                                                                                    <span class="col-md-10">
                                                                                        <input type="file" multiple id="step_file" name="step_file" class="files">
                                                                                    </span>
                                                                                </div>
                                                                                <button type="button" id="add_file" class="btn btn-warning btn-xs col-md-1">
                                                                                    <i class="ace-icon glyphicon-plus  bigger-110 icon-only"></i>
                                                                                </button>
                                                                                <script>

                                                                                </script>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                        <tr>
                                                            <td>Предыдущие комментарии:</td>
                                                        </tr>
                                                        <tr>
                                                            <td> <?= $comments ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button id="agree_btn" class="btn btn-info btn-sm pull-right col-md-2 " data-toggle="modal" data-target="#comments_modal2" >В работу</button>
                    </div>
                </div>
            </div>

            <div class="step-pane" id="step4">
                <!-- step 4 -->
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    num = 0;
    $('#step_file').ace_file_input({
        no_file: "Присоединить файл",
        btn_choose: "Выбрать",
        btn_change: "Изменить",
        enable_reset: true
    });

    num_files = 1;
    $('#add_file').click(function () {
        var str = '<span class="col-md-10"><input type="file" multiple id="step_file' + num_files + '" name="step_file' + num_files + '" class="files"></span><script>    $("#step_file' + num_files + '").ace_file_input({no_file: "Присоединить файл",btn_choose: "Выбрать",btn_change: "Изменить",enable_reset: true});';
        $('#file_div').append(str);
        num_files++;
    });

    $('#srok_otveta').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: "-all earlier dates will be disabled",
        language: "ru",
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true
    });

    $('.com_bt').click(function () {
        id_service_property = $(this).attr('id');
        comments = '';

        $.ajax({
            url: App.options.baseURL + 'ajax/get_property_comments/' + id_service_property + '/' + num,
            type: 'get',
            success: function (data) {
                num = num + 1;
                comments = data;
                jQuery.gritter.add({
                    title: 'Комментарии',
                    text: comments,
                    sticky: true,
                    time: '',
                    class_name: 'gritter-info gritter-light'
                });
            }
        });
    });
    $(".saccess").on('click', function () {
        saccess_button=this;
        bootbox.confirm({
            message: "<h3 align='center'>Согласовать статус полномочия?</h3>",
            buttons: {
                confirm: {
                    label: "Да, согласовать.",
                    className: "btn-primary btn-sm"
                },
                cancel: {
                    label: "Нет не согласовать.",
                    className: "btn-sm"
                }
            },
            callback: function (result) {
                if (result == 1) {
                    $(saccess_button).removeClass('btn-danger').addClass('disabled').text('Статус услуги согласован');
                    $('#status_text').text('Полномочию присвоен статус').css('color','green');
                    $.ajax({
                        url: App.options.baseURL + 'ajax/confirm/' + <?= $id_authority ?>,
                        type: 'get',
                        success: function (data) {
                            if (data == 0) {
                                text = '<h3>Статус успешно присвоен!</h3>';
                                type_greeter = 'gritter-info';
                            } else {
                                text = '<h3>Произошла ошибка при присвоении статуса!</h3>';
                                type_greeter = 'gritter-error';
                            }
                            jQuery.gritter.add({
                                title: "",
                                text: text,
                                sticky: false,
                                time: '',
                                class_name: 'gritter-center ' + type_greeter
                            });
                        }
                    });
                }
            }
        });
    });


</script>

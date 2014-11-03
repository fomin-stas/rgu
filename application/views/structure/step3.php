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
                                <td><?= isset($authority_name) ? $name_iogv : 'не установлено' ?></td>
                            </tr>
                            <tr>
                                <td>№ пункта в положении об ИОГВ:</td>
                                <td><?= isset($punkt_iogv) ? $name_iogv : 'не установлен' ?></td>
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
                                <td><p style="color:red">Ожидает присвоения статуса полномочию</p></td>
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
                                            <a href="file_storage/authority/<?= $file['file_name'] ?>"><?= $file['name'] ?></a>
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
                                <form name="step3_disagree_com" method="post" action="structure/in_work/<?= $id_authority; ?>">
                                    <div class="widget-main padding-16">
                                        <div class="tab-content">
                                            <?php $tab_num = 0; ?>
                                            <?php foreach ($services as $id_sirvices => $service): ?>
                                                <?php $tab_num++; ?>
                                                <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>
                                                    <table class="table table-bordered">
                                                        <?php foreach ($service['properties'] as $name => $value): ?>
                                                            <tr>
                                                                <td class="col-md-4"><?= $value['property_name']; ?></td>
                                                                <td class="col-md-5"><?= $value['value']; ?></td>
                                                                <td class="col-md-3" style="padding-left: 2px">
                                                                    <div class="col-sm-9" style="padding-left: 2px">
                                                                        <label>
                                                                            <input type="radio" class="ace " value="1" <?php if ($value['agreed'] == 1) echo 'checked'; ?> name="<?= $id_sirvices . '_' . $name ?>"> 
                                                                            <span class="lbl">Согласовано</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" class="ace" value="2" <?php if ($value['agreed'] == 2) echo 'checked'; ?> name="<?= $id_sirvices . '_' . $name ?>">
                                                                            <span class="lbl">Не просмотрено</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" class="ace" value="0" <?php if ($value['agreed'] == 0) echo 'checked'; ?> name="<?= $id_sirvices . '_' . $name ?>">
                                                                            <span class="lbl">Не согласовано</span>
                                                                        </label>
                                                                    </div>

                                                                    <div  class=" col-sm-3" style="padding-left: 2px">
                                                                        <button type="button" class="com_bt btn btn-sm btn-primary col-md-12" id="bt_<?= $id_sirvices ?>_<?= $name; ?>">
                                                                            <i class="ace-icon fa fa-comment icon-only"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                    <div class="row">
                                                        <span class="col-md-12">
                                                            <button type="button" class="btn btn-green btn-sm pull-right saccess" id="success_sk_<?= $id_sirvices ?>"><i class="ace-icon fa fa-square-o align-top bigger-125"></i>Согласовать статус функции контроля (надзора)</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="row">
                                            <span class="col-md-6">
                                                <input type="file" multiple id="step_file" name="step_file">
                                            </span>
                                            <div class="form-group pull-right">
                                                <label for="srok_otveta" class="control-label">Срок ответа</label>
                                                <input id="srok_otveta" type="text">
                                            </div>
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

    $('#srok_otveta').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: "-all earlier dates will be disabled",
        language: "ru",
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true
    });

    $('.com_bt').click(function() {
        id_service_property = $(this).attr('id');
        comments = '';

        $.ajax({
            url: App.options.baseURL + 'ajax/get_property_comments/' + id_service_property + '/' + num,
            type: 'get',
            success: function(data) {
                num = num + 1;
                comments = data;
                jQuery.gritter.add({
                    title: '<br>Комментарии',
                    text: comments,
                    sticky: true,
                    time: '',
                    class_name: 'gritter-info gritter-light'
                });
            }
        });
    });
    $(".saccess").on('click', function() {
        id = $(this).attr('id');
        saccess_params = new Array();
        saccess_params = id.split('_');
        bootbox.confirm({
            message: "<h3 align='center'>Согласовать статус статус функции контроля (надзора)?</h3>",
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
            callback: function(result) {
                if (result == 1) {
                    $.ajax({
                        url: App.options.baseURL + 'ajax/confirm/' + saccess_params[1] + '/' + saccess_params[2],
                        type: 'get',
                        success: function() {
                                jQuery.gritter.add({
                                    title: '<h3>Статус успешно присвоен!</h3>',
                                    text: comments,
                                    sticky: true,
                                    time: '',
                                    class_name: 'gritter-center gritter-light'
                                });
                            });
                        }
                    });
                }
            }
        });
    });

</script>

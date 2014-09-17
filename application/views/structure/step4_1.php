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
                <li data-target="#step3" class="complete">
                    <span class="step">3</span>
                    <span class="title">Согласование присвоения статуса</span>
                </li>
                <li data-target="#step4" class="active">
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
                <!-- step 2 -->
            </div>

            <div class="step-pane" id="step3">
                <!-- step 3 -->
            </div>

            <div class="step-pane active" id="step4">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="center" >
                            Полномочию присвоен статус. Полномочие исполняется.
                        </h3>
                                                <table class="table table-striped table-bordered">
                            <tr>
                                <td>ID полномочия:</td>
                                <td><?= $authority_id ?></td>
                            </tr>
                            <tr>
                                <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                <td><?= $authority_name ?></td>
                            </tr>
                            <tr>
                                <td>№ пункта в положении об ИОГВ:</td>
                                <td><?= $punkt_iogv ?></td>
                            </tr>
                            <tr>
                                <td>Наименование ИОГВ СПб:</td>
                                <td><?= $name_iogv ?></td>
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
                                <td><?= $name_iogv ?></td>
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
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <a href="structure/history_polnomoch"><button class="btn btn-info btn-sm">История согласований полномочия</button></a>
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
                                <div class="widget-main padding-16">
                                    <div class="tab-content">
                                        <?php $tab_num = 0; ?>
                                        <?php foreach ($services as $service): ?>
                                            <?php $tab_num++; ?>
                                            <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>
                                                <table class="table table-bordered">
                                                    <?php foreach ($service['properties'] as $name => $value): ?>
                                                        <tr>
                                                            <td class="col-md-4"><?= $name; ?></td>
                                                            <td class="col-md-5"><?= $value; ?></td>
                                                            <td class="col-md-3">
                                                                <label>
                                                                    <input type="checkbox" name="myoption" class="ace ace-switch ace-switch-4 step3 btn-flat" checked />
                                                                    <span class="lbl" data-lbl="Согласовано&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;На редактирование"></span>
                                                                </label>

                                                                <div class="modal fade" id="tr1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <form name="" method="post" action="">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                                    <h4>Комментарий</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <textarea class="input-xxlarge center"></textarea>
                                                                                </div>
                                                                                <div class="modal-footer ">
                                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                                <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История согласований услуги</button></a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <a href="structure/step4_1/<?= $id_authority ?>"><button class="btn btn-grey btn-sm pull-right">Отправить на доработку</button></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script type="text/javascript">
    $('#step_file').ace_file_input({
        no_file: "Присоединить файл",
        btn_choose: "Выбрать",
        btn_change: "Изменить",
        enable_reset: true
    });

    $("#comments_modal2").on("submit", function() {
        location = "step2";
    });
    $('#srok_otveta_3').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHiglight: true
    });

    $('.ace-switch-4.step3').click(function() {
        $(this).parent().siblings('#tr1').modal({
            show: true
        });
    });
</script>
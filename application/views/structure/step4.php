
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
                    <span class="title">Полносмочию присвоен статус</span>
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
                        <h3 class="center">
                            Согласовывать результаты технических обследований централизованных 
                            систем горячего водоснабжения, холодного водоснабжения и водоотведения
                        </h3>
                        <table class="table table-striped">
                            <tr>
                                <td>ID полномочия</td>
                                <td><?= $authority_id ?></td>
                            </tr>
                            <tr>
                                <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                <td><?= $authority_name ?></td>
                            </tr>
                            <tr>
                                <td>Реквизиты постановления</td>
                                <td>Постановление Правительства Санкт-Петербурга от 29.11.2013 № 940 "О мерах по реализации Закона Санкт-Петербурга "О разгранисении полномочий органов государственной власти Санкт-Петербурга в сфере водоснабжения и водоотведения"</td>
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
                            <tr>
                                <td>Статус</td>
                                <td><p style="color:yellowgreen">Ожедает корректировки</p></td>
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
                                        <?php foreach ($services as $id_service => $service): ?>
                                            <?php $tab_num++; ?>
                                            <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>
                                                <form class="form-horizontal" action="structure/update_properties/<?= $id_authority ?>" method="post">
                                                    <fieldset>
                                                        <?= load_form_textaea($id_service, 'sr_0', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_1', $service, true); ?>
                                                        <?= load_form_dropdown($id_service, 'sr_2', $spher, $service, true) ?>
                                                        <?= load_form_dropdown($id_service, 'sr_3', $organization_provide_service, $service, true, true) ?>
                                                        <?= load_form_textaea($id_service, 'sr_4', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_5', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_6', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_7', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_8', $service, true); ?>
                                                        <?= load_form_dropdown($id_service, 'sr_9', array("Юр." => "Юр.", "Физ." => "Физ."), $service, true, true) ?>
                                                        <?= load_form_textaea($id_service, 'sr_10', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_11', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_12', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_13', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_14', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_15', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_16', $service, true); ?>
                                                        <?= load_form_dropdown($id_service, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "по-разному" => "по-разному", "не установлено" => "не установлено"), $service, true, true) ?>
                                                        <?= load_form_textaea($id_service, 'sr_18', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_19', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_20', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_21', $service, true); ?>
                                                        <?= load_form_textaea($id_service, 'sr_22', $service, true); ?>
                                                        <?= load_form_file($id_service, 'sr_23', $service, true); ?>
                                                        <?= load_form_file($id_service, 'sr_24', $service, true); ?>

                                                        <!--<button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>-->
                                                        <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form name="step4_com" method="post">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                                                            <textarea class="input-xxlarge center" name="comment" required></textarea>
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
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-md-6">
                                                                <input type="file" multiple id="step_file" name="step_file" class="files">
                                                            </span>
                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button id="send_btn" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#comments_modal">Отправить на согласование</button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<script type="text/javascript">
    num=0;

$('.files').ace_file_input({
            no_file: "Присоединить файл",
            btn_choose: "Выбрать",
            btn_change: "Изменить",
            enable_reset: true
        });


    $('.com_bt').click(function() {
        //сделать ajax запрос за коментариями
        id_service_property = $(this).attr('id');
        comments = '';

        $.ajax({
            url: App.options.baseURL + 'ajax/get_property_comments/' + id_service_property + '/' + num,
            type: 'get',
            success: function(data) {
                num=num+1;
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
</script>


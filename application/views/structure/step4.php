
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
                                <form class="form-horizontal" action="structure/update_properties/<?= $id_authority ?>" method="post">
                                    <fieldset>
                                        <div class="widget-main padding-16">
                                            <div class="tab-content">
                                                <?php $tab_num = 0; ?>
                                                <?php foreach ($services as $id_service => $service): ?>
                                                    <?php $tab_num++; ?>
                                                    <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>


                                                        <?= isset($service['properties']['sr_0']) ? load_form_textaea($id_service, 'sr_0', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_1']) ? load_form_textaea($id_service, 'sr_1', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_2']) ? load_form_dropdown($id_service, 'sr_2', $spher, $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_3']) ? load_form_dropdown($id_service, 'sr_3', $organization_provide_service, $service, true, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_4']) ? load_form_textaea($id_service, 'sr_4', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_5']) ? load_form_textaea($id_service, 'sr_5', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_6']) ? load_form_textaea($id_service, 'sr_6', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_7']) ? load_form_textaea($id_service, 'sr_7', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_8']) ? load_form_textaea($id_service, 'sr_8', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_9']) ? load_form_dropdown($id_service, 'sr_9', array("Юр." => "Юр.", "Физ." => "Физ."), $service, true, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_10']) ? load_form_textaea($id_service, 'sr_10', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_11']) ? load_form_textaea($id_service, 'sr_11', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_12']) ? load_form_textaea($id_service, 'sr_12', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_13']) ? load_form_textaea($id_service, 'sr_13', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_14']) ? load_form_textaea($id_service, 'sr_14', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_15']) ? load_form_textaea($id_service, 'sr_15', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_16']) ? load_form_textaea($id_service, 'sr_16', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_17']) ? load_form_dropdown($id_service, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "по-разному" => "по-разному", "не установлено" => "не установлено"), $service, true, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_18']) ? load_form_textaea($id_service, 'sr_18', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_19']) ? load_form_textaea($id_service, 'sr_19', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_20']) ? load_form_textaea($id_service, 'sr_20', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_21']) ? load_form_textaea($id_service, 'sr_21', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_22']) ? load_form_textaea($id_service, 'sr_22', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_23']) ? load_form_file($id_service, 'sr_23', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_24']) ? load_form_file($id_service, 'sr_24', $service, true) : ''; ?>

                                                        <?= isset($service['properties']['sn_0']) ? load_form_textaea($id_service, 'sn_0', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_1']) ? load_form_dropdown($id_service, 'sn_1', array("Администрация района" => "Администрация района", "ВФ" => "ВФ", "ГУ" => "ГУ", "ГУЖА" => "ГУЖА", "МУ" => "МУ", "ОМСУ" => "ОМСУ", "ПНО" => "ПНО", "ФОИВ" => "ФОИВ"), $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_2']) ? load_form_textaea($id_service, 'sn_2', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_3']) ? load_form_textaea($id_service, 'sn_3', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_4']) ? load_form_textaea($id_service, 'sn_4', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_5']) ? load_form_textaea($id_service, 'sn_5', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_6']) ? load_form_textaea($id_service, 'sn_6', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_7']) ? load_form_textaea($id_service, 'sn_7', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_8']) ? load_form_textaea($id_service, 'sn_8', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_9']) ? load_form_textaea($id_service, 'sn_9', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_10']) ? load_form_textaea($id_service, 'sn_10', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_11']) ? load_form_textaea($id_service, 'sn_11', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_12']) ? load_form_textaea($id_service, 'sn_12', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_13']) ? load_form_textaea($id_service, 'sn_13', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_14']) ? load_form_dropdown($id_service, 'sn_14', array("ДА" => "ДА", "НЕТ" => "НЕТ"), $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_15']) ? load_form_textaea($id_service, 'sn_15', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_16']) ? load_form_textaea($id_service, 'sn_16', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_17']) ? load_form_textaea($id_service, 'sn_17', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_18']) ? load_form_textaea($id_service, 'sn_18', $service, true) : ''; ?>

                                                        <?= isset($service['properties']['sk_0']) ? load_form_textaea($id_service, 'sk_0', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_1']) ? load_form_textaea($id_service, 'sk_1', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_2']) ? load_form_textaea($id_service, 'sk_2', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_3']) ? load_form_textaea($id_service, 'sk_3', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_4']) ? load_form_textaea($id_service, 'sk_4', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_5']) ? load_form_textaea($id_service, 'sk_5', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_6']) ? load_form_textaea($id_service, 'sk_6', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_7']) ? load_form_textaea($id_service, 'sk_7', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_8']) ? load_form_textaea($id_service, 'sk_8', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_9']) ? load_form_textaea($id_service, 'sk_9', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_10']) ? load_form_textaea($id_service, 'sk_10', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_11']) ? load_form_textaea($id_service, 'sk_11', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_12']) ? load_form_textaea($id_service, 'sk_12', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_13']) ? load_form_textaea($id_service, 'sk_13', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_14']) ? load_form_textaea($id_service, 'sk_14', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_15']) ? load_form_textaea($id_service, 'sk_15', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_16']) ? load_form_textaea($id_service, 'sk_16', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sk_17']) ? load_form_textaea($id_service, 'sk_17', $service, true) : ''; ?>
                                                        
                                                        <!--<button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>-->


                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
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
                                                                <textarea class="input-xxlarge center" name="comment"></textarea>
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
                                        </div>
                                    </fieldset>
                                </form>
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
    num = 0;

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
</script>


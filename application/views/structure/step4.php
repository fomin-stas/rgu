
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
                                <td>ID</td>
                                <td>4676529876</td>
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
                                <td><p style="color:green">КИС согласовал присвоение статуса полномочию</p></td>
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
                                            <li><a href="#usl_<?= $service_num ?>" data-toggle="tab"><?= $service['type']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main padding-16">
                                    <div class="tab-content">
                                        <?php $service_num = 0; ?>
                                        <?php foreach ($services as $service): ?>
                                            <?php $service_num++; ?>
                                            <div class="tab-pane active" id="usl_<?= $service_num; ?>_3">
                                                <form class="form-horizontal">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label for="sr0_<?= $service_num ?>" class="control-label col-md-3">Полное наименование</label>
                                                            <textarea id="sr0_<?= $service_num ?>" name="sr0_<?= $service_num ?>" class="col-md-5"><?php if (isset($service['properties']['sr_0'])) echo $service['properties']['sr_0']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr1_<?= $service_num ?>" class="control-label col-md-6">Краткое наименование услуги</label>
                                                            <textarea id="sr1_<?= $service_num ?>" name="sr1_<?= $service_num ?>" class="col-md-5"><?php if (isset($service['properties']['sr_1'])) echo $service['properties']['sr_1']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="spher" class="control-label col-md-6">Сфера предоставления</label>
                                                            <?= form_dropdown('spher', $spher, $service['properties']['sr_2'], 'id="spher" class="col-md-5"'); ?>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="organization_provide_service" class="control-label col-md-6">Наименование органов, участвующих в предоставлении услуги</label>
                                                            <?= form_multiselect('organization_provide_service', $organization_provide_service, '', 'id="organization_provide_service" class="col-md-5"'); ?>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr4_<?= $service_num ?>" class="control-label col-md-6">Перечень НПА РФ, регулирующих предоставление услуги</label>
                                                            <textarea id="sr4_<?= $service_num ?>" name='sr4_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_4'])) echo $service['properties']['sr_4']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr5_<?= $service_num ?>" class="control-label col-md-6">Перечень НПА СПб</label>
                                                            <textarea id="sr5_<?= $service_num ?>" name='sr5_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_5'])) echo $service['properties']['sr_5']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr6_<?= $service_num ?>" class="control-label col-md-6">Способы предоставления услуги</label>
                                                            <?= form_dropdown('sr6_' . $service_num, array("в традиционном порядке" => "в традиционном порядке", "через МФЦ" => "через МФЦ", "в электронном виде" => "в электронном виде"), $service['properties']['sr_6'], 'id="sr6_' . $service_num . '" name="sr6_' . $service_num . '" class="col-md-5"'); ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr7_<?= $service_num ?>" class="control-label col-md-6">Результат предоставления</label>
                                                            <textarea id="sr7_<?= $service_num ?>" name='sr7_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_7'])) echo $service['properties']['sr_7']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr8_<?= $service_num ?>" class="control-label col-md-6">Срок предоставления</label>
                                                            <textarea id="sr8_<?= $service_num ?>" name='sr8_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_8'])) echo $service['properties']['sr_8']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr9_<?= $service_num ?>" class="control-label col-md-6">Тип заявителя</label>
                                                            <?= form_dropdown('sr6_' . $service_num, array("Юр." => "Юр.", "Физ." => "Физ.", "Юр./Физ." => "Юр./Физ."), $service['properties']['sr_9'], 'id="sr9_' . $service_num . '" name="sr9_' . $service_num . '" class="col-md-5"'); ?>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr10_<?= $service_num ?>" class="control-label col-md-6">Категория заявителей</label>
                                                            <textarea id="sr10_<?= $service_num ?>" name='sr8_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_10'])) echo $service['properties']['sr_10']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr11_<?= $service_num ?>" class="control-label col-md-6">Сведения о местах, в которых можно получить информацию</label>
                                                            <textarea id="sr11_<?= $service_num ?>" name='sr11_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_11'])) echo $service['properties']['sr_11']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr12_<?= $service_num ?>" class="control-label col-md-6">Срок, в течение которого заявление должно быть зарегистрировано</label>
                                                            <textarea id="sr12_<?= $service_num ?>" name='sr12_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_12'])) echo $service['properties']['sr_12']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr13_<?= $service_num ?>" class="control-label col-md-6">Максимальный срок ожидания в очереди</label>
                                                            <textarea id="sr13_<?= $service_num ?>" name='sr13_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_13'])) echo $service['properties']['sr_13']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr14_<?= $service_num ?>" class="control-label col-md-6">Основания для приостановления предоставления либо откаsr14_<?= $service_num ?>за в предоставлении услуги (если возможность приостановления либо отказа в предоставлении услуги предусмотрена законодательством Российской Федерации).</label>
                                                            <textarea id="sr14_<?= $service_num ?>" name='sr14_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_14'])) echo $service['properties']['sr_14']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr15_<?= $service_num ?>" class="control-label col-md-6">Перечень необходимых документов</label>
                                                            <textarea id="sr15_<?= $service_num ?>" name='sr15_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_15'])) echo $service['properties']['sr_15']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr16_<?= $service_num ?>" class="control-label col-md-6">Способы получения этих документов (услуги, в результате которых можно получить документы)</label>
                                                            <textarea id="sr16_<?= $service_num ?>" name='sr16_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_16'])) echo $service['properties']['sr_16']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr17_<?= $service_num ?>" class="control-label col-md-6">Сведения о возмездности услуги</label>
                                                            <?= form_dropdown('sr17_' . $service_num, array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "по-разному" => "по-разному", "не установлено" => "не установлено"), $service['properties']['sr_17'], 'id="sr17_' . $service_num . '" name="sr17_' . $service_num . '" class="col-md-5"'); ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr18_<?= $service_num ?>" class="control-label col-md-6">Стоимость услуги</label>
                                                            <textarea id="sr18_<?= $service_num ?>" name='sr18_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_18'])) echo $service['properties']['sr_18']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr19_<?= $service_num ?>" class="control-label col-md-6">Показатели доступности и качества услуги</label>
                                                            <textarea id="sr19_<?= $service_num ?>" name='sr19_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_19'])) echo $service['properties']['sr_19']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr20_<?= $service_num ?>" class="control-label col-md-6">Информация о внутриведомственных и межведомственных процедурах</label>
                                                            <textarea id="sr20_<?= $service_num ?>" name='sr14_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_20'])) echo $service['properties']['sr_20']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr21_<?= $service_num ?>" class="control-label col-md-6">Сведения о допустимости </label>
                                                            <textarea id="sr21_<?= $service_num ?>" name='sr21_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_21'])) echo $service['properties']['sr_21']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr22_<?= $service_num ?>" class="control-label col-md-6">Наличие межведомственного взаимодействия</label>
                                                            <textarea id="sr22_<?= $service_num ?>" name='sr14_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_22'])) echo $service['properties']['sr_22']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr23_<?= $service_num ?>" class="control-label col-md-6">Технологическая карта межведомственного взаимодействия</label>
                                                            <textarea id="sr23_<?= $service_num ?>" name='sr23_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_23'])) echo $service['properties']['sr_23']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sr24s_<?= $service_num ?>" class="control-label col-md-6">Краткое описание</label>
                                                            <textarea id="sr24_<?= $service_num ?>" name='sr14_<?= $service_num ?>' class="col-md-5"><?php if (isset($service['properties']['sr_24'])) echo $service['properties']['sr_24']; ?></textarea>
                                                        </div>
                                                        <button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>

                                                    </fieldset>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>



                                    </div>
                                    <div class="row">
                                        <span class="col-md-6">
                                            <input type="file" multiple id="step_file" name="step_file">
                                        </span>
                                        <div class="form-group pull-right">
                                            <label for="sogl_inst" class="control-label">Согласующие инстанции</label>
                                            <select id="sogl_inst" class="">
                                                <option>Комитет по информации и связи</option>
                                                <option>Другое</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button id="send_btn" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#comments_modal">Отправить на согласование</button>
                        <a href="structure/step4_1">
                            <button class="btn btn-grey btn-sm pull-right">Предварительный просмотр</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="step4_com" method="post">
                <div class="modal-header">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <a href="structure/step3"><button type="submit" class="btn btn-primary">Отправить</button></a>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                    <textarea class="input-xxlarge center" name="comment_st4" required></textarea>
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


<script type="text/javascript">
    $('#step_file').ace_file_input({
        no_file: "Присоединить файл",
        btn_choose: "Выбрать",
        btn_change: "Изменить",
        onchange: null,
        enable_reset: true
    });
</script>


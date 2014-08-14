
<div class="main-container">
    <div class="container">
        <div id="my-wizard" data-target="#step-container" class="wizard">
            <ul class="wizard-steps">
                <li data-target="#step1" class="active">
                    <span class="step">1</span>
                    <span class="title">Новое полномочие</span>
                </li>
                <li data-target="#step2">
                    <span class="step">2</span>
                    <span class="title">Присвоение статуса полномочию</span>
                </li>
                <li data-target="#step3">
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
            <div class="step-pane active" id="step1">
                <form class="form-horizontal" method="post" role="form" action="structure/step1_submit">
                    <fieldset>
                        <div class="col-md-offset-1">
                            <h4 class="col-md-10 center">Добавление нового полномочия</h4>
                            <div class="row">
                                <div class="form-group">
                                    <label for="name_authority" class="control-label col-md-5">Наименование полномочия в соответствии с Положением об ИОГВ</label>
                                    <textarea id="name_authority" name="name_authority" class="col-md-5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="punkt_iogv" class="control-label col-md-5">№ пункта в положении об ИОГВ</label>
                                    <textarea id="punkt_iogv" name="punkt_iogv" class="col-md-5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name_iogv" class="control-label col-md-5">Наименование ИОГВ СПб</label>
                                    <?= form_dropdown('name_iogv', $db_iogv, '', 'id="name_iogv" class="col-md-5"'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="rekvisit_npa" class="control-label col-md-5">Реквизиты НПА, которыми полномочие передано для осуществления ИОГВ субъекта РФ с федерального уровня</label>
                                    <textarea id="rekvisit_npa" name="rekvisit_npa" class="col-md-5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="project_post" class="control-label col-md-5">Проект постановления Правительства (наименование и дата согласования Юридическим комитетом)</label>
                                    <textarea id="project_post" name="project_post" class="col-md-5"></textarea>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-10">
                                        <a href="structure/arm_kis"><input type="button" class="btn btn-grey pull-right btn-sm col-md-3" value="Закрыть"></a>
                                        <a href="structure/step1"><input type="button" class="btn btn-info pull-right btn-sm col-md-3" value="Сохранить как черновик"></a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group pull-left">
                                        <label for="select_org" class="control-label col-md-5">Выберите организацию</label> 
                                        <?= form_dropdown('select_org', $db, $db[1], 'id="select_org" class="col-md-5"'); ?>
                                    </div>
                                    <div class="form-group pull-right">
                                        <label class="control-label" for="srok_otveta">Установите срок ответа</label>
                                        <input type="text" name="srok_otveta" id="srok_otveta">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <span class="col-md-6">
                                        <input type="file" multiple id="step1_file" name="step1_file[]">
                                    </span>
                                    <input type="button" id="send_btn" class="btn btn-info pull-right"  data-toggle="modal" data-target="#comments_modal" value="Отправить в работу">
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="input-xxlarge center" name="comment_st1"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-primary">Отправить</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>

            <div class="step-pane" id="step2">
                <!-- step 2 -->
            </div>

            <div class="step-pane" id="step3">
                <!-- step 3 -->
            </div>

            <div class="step-pane" id="step4">
                <!-- step 4 -->
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">
    $('#step1_file').ace_file_input({
        no_file: "Присоединить файл",
        btn_choose: "Выбрать",
        btn_change: "Изменить",
        enable_reset: true
    });
    $('#srok_otveta').datepicker({
        autoclose: true,
        todayHiglight: true
    });
</script>

<div class="main-container">
    <div class="container">
        <div id="my-wizard" data-target="#step-container" class="wizard">
            <ul class="wizard-steps">
                <li data-target="#step1" class="complete">
                    <span class="step" >1</span>
                    <span class="title">Новое полномочие</span>
                </li>
                <li data-target="#step2" class="active">
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
            <div class="step-pane" id="step1">
                <!-- step 1-->
            </div>

            <div class="step-pane active" id="step2">

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
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
                                <td>Статус:</td>
                                <td><p style="color:red">Ожидает присвоения статуса полномочия</p></td>
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
                        <button class="btn btn-info btn-sm pull-left add_sr_btn">Услуга</button>
                        <button class="btn btn-info btn-sm pull-left add_sn_btn">Функция</button>
                        <button class="btn btn-info btn-sm pull-left add_skn_btn">Функция контроля и надзора</button>
                    </div>
                </div>
                <form name="step2_com" method="post" action="structure/step2_submit">
                    <input value="<?= $id_authority ?>" name="id_authority" hidden>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <div class="widget-toolbar">
                                        <ul id='razgran_u_f_tabs' class='nav nav-tabs'></ul>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main padding-16">
                                        <div class="tab-content" id="tab_content"></div>
                                        <div class="row">
                                            <span class="col-md-6">
                                                <input type="file" multiple id="step2_file" name="step2_file[]">
                                            </span>
                                            <div class="form-group pull-right">
                                                <label for="sogl_inst" class="control-label">Согласующие инстанции</label>
                                                <select id="sogl_inst" class="">
                                                    <option>Комитет по информации и связи</option>
                                                    <option>КРИОГВ</option>
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
                            <button class="btn btn-info btn-sm pull-left add_sr_btn">Добавить услугу</button>
                            <button class="btn btn-info btn-sm pull-left add_sn_btn">Добавить функцию</button>
                            <button class="btn btn-info btn-sm pull-left add_skn_btn">Добавить функцию контроля и надзора</button>
                            <button id="send_btn" class="btn btn-info btn-sm pull-right">Отправить на согласование</button>
                        </div>
                    </div>
                    <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="clear" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                    <textarea class="input-xxlarge left" name="comment_st2" required></textarea>
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
            <div class="step-pane" id="step3">
                <!-- step 3 -->
            </div>
            <div class="step-pane" id="step4">
                <!-- step 4 -->
            </div>
        </div>
    </div>
</div>

<div class="tab-pane" id="sr" hidden>
    <div class="form-horizontal" method="post" name="sr_form">
        <div>
            <div class="form-group">
                <label for="full_name_sr" class="control-label col-md-6">Наименование услуги</label>
                <textarea id="full_name_sr" name="service_name" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="short_name_sr" class="control-label col-md-6">Краткое наименование услуги</label>
                <textarea id="short_name_sr" name="short_service_name" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="spher" class="control-label col-md-6">Сфера предоставления</label>
                <?= form_dropdown('spher', $spher, '', 'id="spher" class="col-md-5"'); ?>

            </div>
            <div class="form-group">
                <label for="organization_provide_service" class="control-label col-md-6">Наименование органов, участвующих в предоставлении услуги</label>
                <input  name="organization_provide_service" class="col-md-5" id="organization_provide_service" value="zzzz" />
<!--
                <script>
                    var tag_input = $('#sr1_3');
                    try {
                        tag_input.tag({
                            placeholder: tag_input.attr('placeholder'),
                            source: <?= $organization_provide_service ?>
                        });
                    }
                    catch (e) {
                        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                        tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
                    }
                </script>
-->
            </div>
            <div class="form-group">
                <label for="list_npa_rf_sr" class="control-label col-md-6">Перечень НПА РФ, регулирующих предоставление услуги</label>
                <textarea id="list_npa_rf_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="list_npa_spb_sr" class="control-label col-md-6">Перечень НПА СПб</label>
                <textarea id="list_npa_spb_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="type_prd_sr" class="control-label col-md-6">Способы предоставления услуги</label>
                <select id="type_prd_sr" name="type_prd_sr" class="col-md-5">
                    <option value="в традиционном порядке">в традиционном порядке</option>
                    <option value="через МФЦ">через МФЦ</option>
                    <option value="в электронном виде">в электронном виде</option>
                </select>
            </div>
            <div class="form-group">
                <label for="result_sr" class="control-label col-md-6">Результат предоставления</label>
                <textarea id="result_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="srok_predost_sr" class="control-label col-md-6">Срок предоставления</label>
                <textarea id="srok_predost_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="type_z_sr" class="control-label col-md-6">Тип заявителя</label>
                <select id="type_z_sr" class="col-md-5">
                    <option value="Юр.">Юр.</option>
                    <option value="Физ.">Физ.</option>
                    <option value="Юр./Физ.">Юр./Физ.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categ_z_sr" class="control-label col-md-6">Категория заявителей</label>
                <textarea id="categ_z_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="info_plc_sr" class="control-label col-md-6">Сведения о местах, в которых можно получить информацию</label>
                <textarea id="info_plc_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="reg_time_sr" class="control-label col-md-6">Срок, в течение которого заявление должно быть зарегистрировано</label>
                <textarea id="reg_time_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="max_w_time_sr" class="control-label col-md-6">Максимальный срок ожидания в очереди</label>
                <textarea id="max_w_time_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="stop_reasons_sr" class="control-label col-md-6">Основания для приостановления предоставления либо отказа в предоставлении услуги (если возможность приостановления либо отказа в предоставлении услуги предусмотрена законодательством Российской Федерации).</label>
                <textarea id="stop_reasons_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="doc_list_sr" class="control-label col-md-6">Перечень необходимых документов</label>
                <textarea id="doc_list_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="howto_get_docs_sr" class="control-label col-md-6">Способы получения этих документов (услуги, в результате которых можно получить документы)</label>
                <textarea id="howto_get_docs_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="vozm_sr" class="control-label col-md-6">Сведения о возмездности услуги</label>
                <select id="vozm_sr" class="col-md-5">
                    <option value="безвозмездно">безвозмездно</option>
                    <option value="возмездно">возмездно</option>
                    <option value="по-разному">по-разному</option>
                    <option value="не установлено">не установлено</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cost_sr" class="control-label col-md-6">Стоимость услуги</label>
                <textarea id="cost_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="quality_sr" class="control-label col-md-6">Показатели доступности и качества услуги</label>
                <textarea id="quality_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="inner_proc_sr" class="control-label col-md-6">Информация о внутриведомственных и межведомственных процедурах</label>
                <textarea id="inner_proc_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="dopust_sr" class="control-label col-md-6">Сведения о допустимости </label>
                <textarea id="dopust_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="has_coop_sr" class="control-label col-md-6">Наличие межведомственного взаимодействия</label>
                <textarea id="has_coop_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="coop_map_sr" class="control-label col-md-6">Технологическая карта межведомственного взаимодействия</label>
                <textarea id="coop_map_sr" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="opisanie_sr" class="control-label col-md-6">Краткое описание</label>
                <textarea id="opisanie_sr" class="col-md-5"></textarea>
            </div>
            <button type="button" class="btn btn-info btn-sm pull-left" id="save_as_chern_sr">Сохранить как черновик</button>
            <button type="button" class="btn btn-grey btn-sm pull-left delete_this_pane">Удалить</button>
        </div>
    </div>
</div>

<div class="tab-pane" id="sn" hidden>
    <div class="form-horizontal" name="sn_form">
        <div>
            <div class="form-group">
                <label for="full_name_sn" class="control-label col-md-6">Наименование</label>
                <textarea id="full_name_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="target_item_sn" class="control-label col-md-6">код и название целевой статьи бюджета СПб</label>
                <textarea id="target_item_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="req_rf_sn" class="control-label col-md-6"> Реквизиты нормативных правовых актов Российской Федерации, в соответствии с которыми осуществляется исполнение государственной функции (с указанием номера статьи (пункта)</label>
                <textarea id="req_rf_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="req_spb_sn" class="control-label col-md-6"> Реквизиты нормативных правовых актов Санкт-Петербурга (исполнительных органов государственной власти Санкт-Петербурга), в соответствии с которыми осуществляется исполнение государственной функции (с указанием номера статьи (пункта)</label>
                <textarea id="req_spb_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="iogv_act_sn" class="control-label col-md-6">действия, которые выполняет ИОГВ</label>
                <textarea id="iogv_act_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="organ_vyp_sn" class="control-label col-md-6">Органы, в отношении которых выполняются действия</label>
                <select id="organ_vyp_sn" class="col-md-5">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="org_isp_sn" class="control-label col-md-6">Организации, принимающие участие в исполнении функции</label>
                <select id="org_isp_sn" class="col-md-5">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="org_act_sn" class="control-label col-md-6">действия, выполняемые организацией</label>
                <textarea id="org_act_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="coop_names_sn" class="control-label col-md-6">название органов, с которыми осуществляется межведомственное взаимодействие</label>
                <textarea id="coop_names_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="coop_type_sn" class="control-label col-md-6">способ осуществления межведомственного взаимодействия</label>
                <textarea id="coop_type_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="name_is_sn" class="control-label col-md-6">наименование информационной системы, в которой учитывается результат</label>
                <textarea id="name_is_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="time_sn" class="control-label col-md-6">срок исполнения</label>
                <textarea id="result_isp_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="result_isp_sn" class="control-label col-md-6">Результат исполнения функции</label>
                <textarea id="result_isp_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="neobh_otchetn" class="control-label col-md-6">необходимость формирования отчетности</label>
                <select id="neobh_otchetn" class="col-md-5">
                    <option>Нет</option>
                    <option>Да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="list_info_org_sn" class="control-label col-md-6">перечень органов, от которых необходимо получать информацию для отчетности</label>
                <textarea id="list_info_org_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="interval_sn" class="control-label col-md-6">периодичность предоставления отчетов</label>
                <textarea id="interval_sn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="form_oth_sn" class="control-label col-md-6">форма отчета</label>
                <textarea id="form_oth_sn" class="col-md-5"></textarea>
            </div>
            <button type="button" class="btn btn-info btn-sm pull-left" id="save_as_chern_sr">Сохранить как черновик</button>
            <button type="button" class="btn btn-grey btn-sm pull-left delete_this_pane">Удалить</button>
        </div>
    </div>
</div>

<div class="tab-pane" id="sk" hidden>
    <div class="form-horizontal" name="skn_form">
        <div>
            <div class="form-group">
                <label for="name_skn" class="control-label col-md-6">Наименование государственной (муниципальной) функции контроля (надзора) </label>
                <textarea id="name_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="short_name_skn" class="control-label col-md-6">Краткое наименование функции контроля (надзора)</label>
                <textarea id="short_name_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="act_list_skn" class="control-label col-md-6">Перечень и тексты нормативных правовых актов, непосредственно регулирующих исполнение функции контроля (надзора), с указанием их реквизитов и источников официального опубликования (в том числе наименование и текст административного регламента с указанием реквизитов утвердившего его нормативного правового акта и источников официального опубликования либо наименование и текст проекта административного регламента).</label>
                <textarea id="act_list_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="control_obj_skn" class="control-label col-md-6">Предмет государственного контроля (надзора) и муниципального контроля </label>
                <textarea id="control_obj_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="rights_obj_skn" class="control-label col-md-6">Права и обязанности должностных лиц при осуществлении контроля (надзора).</label>
                <textarea id="rights_obj_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="righs_subj_skn" class="control-label col-md-6">Права и обязанности лиц, в отношении которых осуществляются мероприятия по контролю (надзору).</label>
                <textarea id="righs_subj_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="result_skn" class="control-label col-md-6">Описание результата исполнения функции контроля (надзора).</label>
                <textarea id="result_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="obj_cat_skn" class="control-label col-md-6">Категории лиц, в отношении которых проводятся мероприятия по контролю (надзору).</label>
                <textarea id="obj_cat_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="info_plc_skn" class="control-label col-md-6">Сведения о местах, в которых можно получить информацию о порядке исполнения функции контроля (надзора), в том числе телефоны центра телефонного обслуживания граждан и организаций при их наличии.</label>
                <textarea id="info_plc_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="time_isp_skn" class="control-label col-md-6">Срок исполнения функции контроля (надзора) (в том числе с учетом необходимости взаимодействия с федеральными органами исполнительной власти, органами государственных внебюджетных фондов, исполнительными органами государственной власти субъектов Российской Федерации, органами местного самоуправления, учреждениями (организациями).</label>
                <textarea id="time_isp_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="stop_reasons_skn" class="control-label col-md-6">Основания для приостановления проведения контрольного (надзорного) мероприятия (действия) в рамках исполнения функции контроля (надзора) и предельно допустимая продолжительность этого приостановления (если возможность приостановления предусмотрена законодательством Российской Федерации).</label>
                <textarea id="stop_reasons_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="inner_proc_skn" class="control-label col-md-6">Информация о внутриведомственных и межведомственных административных процедурах, подлежащих выполнению федеральным органом исполнительной власти, исполнительным органом государственной власти субъекта Российской Федерации или органом местного самоуправления при исполнении функции контроля (надзора), в том числе информация о промежуточных и окончательных сроках таких административных процедур.</label>
                <textarea id="inner_proc_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="info_appeal_skn" class="control-label col-md-6">Сведения о допустимости (возможности) и порядке досудебного (внесудебного) обжалования решений и действий (бездействия) органа, исполняющего функцию контроля (надзора)</label>
                <textarea id="info_appeal_skn" class="col-md-5"></textarea>
            </div>
            <div class="form-group">
                <label for="map_coop_skn" class="control-label col-md-6">Технологическая карта межведомственного взаимодействия (при наличии взаимодействия с федеральными органами исполнительной власти, органами государственных внебюджетных фондов, исполнительными органами государственной власти Санкт-Петербурга, органами местного самоуправления в Санкт-Петербурге, учреждениями (организациями) при исполнении функции по контролю (надзору</label>
                <textarea id="map_coop_skn" class="col-md-5"></textarea>
            </div>
            <button type="button" class="btn btn-info btn-sm pull-left" id="save_as_chern_skn">Сохранить как черновик</button>
            <button type="button" class="btn btn-grey btn-sm pull-left delete_this_pane">Удалить</button>
        </div>
    </div>
</div>

<div class="modal fade" id="alert_fieldrequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Некоторые поля остались незаполненными.</h4>
            </div>
            <div class="modal-body">
                Внесите необходимые данные и попробуйте еще раз.
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#step2_file').ace_file_input({
        no_file: "Присоединить файл",
        btn_choose: "Выбрать",
        btn_change: "Изменить",
        enable_reset: true
    });
    $('#send_btn').on('click', function() {
        var text_fields = $('#tab_content textarea');
        for (var textarea = 0; textarea < text_fields.length; textarea++) {
            console.log(text_fields[textarea].value);
            if (!text_fields[textarea].value) {
                console.log(text_fields[textarea]);
//                text_fields[textarea].before("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>Заполните это поле</div>");
//                text_fields[textarea].css('border','1px solid red');
                $('#alert_fieldrequest').modal('show');
                return 'empty textarea';
            }
        }
        $('#comments_modal').modal('show');
    });

    //add new functions and services
    var num = {sr: 1, sn: 1, skn: 1};
    function add_new_tab(type)
    {
        var tab_pane = $('#' + type).clone().attr('id', 'pane_' + type + num[type]); //clone existing tab-pane template and change id
        tab_pane[0].firstElementChild.id = 'form_' + type + num[type]; //give it new id and name
        tab_pane[0].firstElementChild.name += num[type];
        function tab_text()
        {
            if (type == 'sr') {
                return 'Услуга';
            }
            else if (type == 'sn') {
                return 'Функция';
            }
            else {
                return 'Функция контроля/надзора';
            }
        }

        //insert navigation-tab and content
        var tab = "<li id='navtab_" + type + num[type] + "'><a href='#" + tab_pane[0].id + "' data-toggle='tab'>" + tab_text() + " " + num[type] + "</a></li>";
        $('#razgran_u_f_tabs').append(tab);
        $('#tab_content').append(tab_pane[0]);

        //rename inputs and labels into type[num]_[i] form
        for (var i = 0; i < $('#form_' + type + num[type] + ' label').length; i++)
        {
            $('#form_' + type + num[type] + ' label')[i].setAttribute('for', type + num[type] + '_' + i);
            $('#form_' + type + num[type] + ' label')[i].nextElementSibling.setAttribute('id', type + num[type] + '_' + i);
            $('#form_' + type + num[type] + ' label')[i].nextElementSibling.setAttribute('name', type + num[type] + '_' + i);
            $('#form_' + type + num[type] + ' label')[i].nextElementSibling.setAttribute('required', 'required');
        }
        
        //change textarea to tag-input
        if (type=='sr')
        {
			var tag_input = $('#'+type + num[type] + '_3');
			try {
				tag_input.tag({
					placeholder: tag_input.attr('placeholder'),
					source: "<?= $organization_provide_service ?>"
				});
			}
			catch (e) {
				//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
				tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
			}
		}        

        //delete-buttons logic
        $('#' + tab_pane[0].id + ' .delete_this_pane')[0].addEventListener('click', function() {
            var tab_main = this.parentNode.parentNode;
            $('#navtab_' + tab_main.id).remove();
            tab_main.remove();
        });
        num[type]++;
    }
    $(".add_sr_btn").on('click', function() {
        add_new_tab("sr");
    });
    $(".add_sn_btn").on('click', function() {
        add_new_tab("sn");
    });
    $(".add_skn_btn").on('click', function() {
        add_new_tab("skn");
    });
</script>


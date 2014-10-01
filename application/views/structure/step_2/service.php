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

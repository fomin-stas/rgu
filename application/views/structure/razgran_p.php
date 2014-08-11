
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
                            <span class="title">Согласование разграничения</span>
                        </li>
                        <li data-target="#step4">
                            <span class="step">4</span>
                            <span class="title">Согласовано</span>
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
                                        <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                        <td>Обеспечивать в пределах компетенции Комитета выполнение федеральных программ, в реализации которых участвует Санкт-Петербург, а также программ развития Санкт-Петербурга</td>
                                    </tr>
                                    <tr>
                                        <td>Внесены изменения в Положение об ИОГВ (реквизиты НПА)</td>
                                        <td>п. 3.19 в ред. Постановления Правительства Санкт-Петербурга от 11.12.2013 N 983</td>
                                    </tr>
                                    <tr>
                                        <td>№ пункта в Положении об ИОГВ:</td>
                                        <td>3.19</td>
                                    </tr>
                                    <tr>
                                        <td>Полномочие осуществляется с использованием ИС</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <table class="table table-striped table-condensed">
                                    <tr>
                                        <td>Ответственный орган:</td>
                                        <td>Комитет по энергетике и инженерному обеспечению</td>
                                    </tr>
                                    <tr>
                                        <td>Статус:</td>
                                        <td><p style="color:red">Ожидает разграничения</p></td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий:</td>
                                        <td><a href="structure/timeline">Читать комментарии(1)</a></td>
                                    </tr>
                                    <tr>
                                        <td>Приложенные файлы</td>
                                        <td>
                                            <a href="structure/step2">file_1.jpg</a>
                                            ,
                                            <a href="structure/step2">file_2.zip</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <button class="btn btn-info btn-sm pull-left" id="add_usl_btn">Добавить услугу</button>
                                <button class="btn btn-info btn-sm pull-left" id="add_func_btn">Добавить функцию</button>
                                <button class="btn btn-info btn-sm pull-left" id="add_fcn_btn">Добавить функцию контроля и надзора</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <div class="widget-toolbar">
                                            <ul id="razgran_u_f_tabs" class="nav nav-tabs">
                                                <li><a href="#usl_1" data-toggle="tab">Услуга 1</a></li>
                                                <li><a href="#func_1" data-toggle="tab">Функция 1</a></li>
                                                <li><a href="#func_cn_1" data-toggle="tab">Функция контроля и надзора 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main padding-16">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="usl_1">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <label for="full_name_usl" class="control-label col-md-3">Полное наименование</label>
                                                                <textarea id="full_name_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="short_name_usl" class="control-label col-md-3">Краткое наименование</label>
                                                                <textarea id="short_name_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sfera" class="control-label col-md-3">Сфера</label>
                                                                <select id="sfera" class="col-md-5">
                                                                    <option>Природопользование и экология</option>
                                                                    <option>образование и наука</option>
                                                                    <option>Здравоохранение</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="usl_okaz" class="control-label col-md-3">Услугу оказывает</label>
                                                                <select id="usl_okaz" class="col-md-5">
                                                                    <option>Администрации районов Санкт-Петербурга</option>
                                                                    <option>Комитет по энергетике и инжеерному обеспечению</option>
                                                                    <option>Подведомственное учреждение</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="result_usl" class="control-label col-md-3">Результат предоставления</label>
                                                                <textarea id="result_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="srok_predost_usl" class="control-label col-md-3">Срок предоставления</label>
                                                                <textarea id="srok_predost_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kateg_z_usl" class="control-label col-md-3">Категория заявителей</label>
                                                                <textarea id="kateg_z_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sp_predost_usl" class="control-label col-md-3">Способ предоставления</label>
                                                                <textarea id="sp_predost_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="opisanie_usl" class="control-label col-md-3">Краткое описание</label>
                                                                <textarea id="opisanie_usl" class="col-md-5"></textarea>
                                                            </div>
                                                            <button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>
                                                            <button class="btn btn-grey btn-sm pull-left">Удалить</button>

                                                        </fieldset>
                                                    </form>
                                                </div>

                                                <div class="tab-pane" id="func_1">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <label for="full_name_func" class="control-label col-md-3">Наименование</label>
                                                                <textarea id="full_name_func" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vyp_deistv_func" class="control-label col-md-3">Выполняемые действия</label>
                                                                <textarea id="vyp_deistv_func" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="organ_vyp_func" class="control-label col-md-3">Органы, в отношении которых выполняются действия</label>
                                                                <select id="organ_vyp_func" class="col-md-5">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="org_isp_func" class="control-label col-md-3">Организации, принимающие участие в исполнении функции</label>
                                                                <select id="org_isp_func" class="col-md-5">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vyp_deistv" class="control-label col-md-3">Выполняемые действия</label>
                                                                <textarea id="vyp_deistv" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="result_isp_func" class="control-label col-md-3">Результат исполнения функции</label>
                                                                <textarea id="result_isp_func" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="neobh_otchetn" class="control-label col-md-3">необходимость формирования отчетности</label>
                                                                <select id="neobh_otchetn" class="col-md-5">
                                                                    <option>Нет</option>
                                                                    <option>Да</option>
                                                                </select>
                                                            </div>                                                    
                                                            <button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>
                                                            <button class="btn btn-grey btn-sm pull-left">Удалить</button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                                
                                                <div class="tab-pane" id="func_cn_1">
                                                    <form class="form-horizontal">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <label for="full_name_func_cn" class="control-label col-md-3">Наименование</label>
                                                                <textarea id="full_name_func_cn" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deistv_func_cn" class="control-label col-md-3">Выполняемые действия</label>
                                                                <textarea id="deistv_func_cn" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="organ_func_cn" class="control-label col-md-3">Органы, в отношении которых выполняются действия</label>
                                                                <select id="organ_func_cn" class="col-md-5">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="org_isp_func_cn" class="control-label col-md-3">Организации, принимающие участие в исполнении функции</label>
                                                                <select id="org_isp_func_cn" class="col-md-5">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vyp_deistv_cn" class="control-label col-md-3">Выполняемые действия</label>
                                                                <textarea id="vyp_deistv_cn" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="result_func_cn" class="control-label col-md-3">Результат исполнения функции</label>
                                                                <textarea id="result_func_cn" class="col-md-5"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="neobh_otchet_cn" class="control-label col-md-3">необходимость формирования отчетности</label>
                                                                <select id="neobh_otchet_cn" class="col-md-5">
                                                                    <option>Нет</option>
                                                                    <option>Да</option>
                                                                </select>
                                                            </div>                                                    
                                                            <button class="btn btn-info btn-sm pull-left" id="save_as_chern_func_cn">Сохранить как черновик</button>
                                                            <button class="btn btn-grey btn-sm pull-left">Удалить</button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row">
                                                <span class="col-md-6">
                                                    <input type="file" multiple id="step2_file" name="step2_file[]">
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
                                <button class="btn btn-info btn-sm pull-left" id="add_usl_btn">Добавить услугу</button>
                                <button class="btn btn-info btn-sm pull-left" id="add_func_btn">Добавить функцию</button>
                                <button class="btn btn-info btn-sm pull-left" id="add_fcn_btn">Добавить функцию контроля и надзора</button>
                            
                                <button id="send_btn" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#comments_modal">Отправить на согласование</button>
                            </div>
                        </div>
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
        
        <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="step2_com" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="input-xxlarge center" name="comment_st2" required></textarea>
                            <div class="space-6"></div>
                            <table class="table">
                                <tr>
                                    <td>Предыдущие комментарии:</td>
                                    <td>Комментариев нет</td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <a href="structure/step3"><button type="submit" class="btn btn-primary">Отправить</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
        <script type="text/javascript">
            $('#my-wizard')
            .ace_wizard({
                step: 2 
            }).on('stepclick', function(e) {
                e.preventDefault();
            });
            $('#step2_file').ace_file_input({
                no_file: "Присоединить файл",
                btn_choose:"Выбрать",
                btn_change:"Изменить",
                enable_reset: true
            });
        </script>
   
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>" />
        <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace-fonts.css" type="text/css" rel="stylesheet" />
        <link href="static/css/datepicker.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace.min.css" type="text/css" rel="stylesheet" />
        <!--[if lte IE 9>
        <link href="static/css/ace-part2.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 9>
        <link href="static/css/ace-ie.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <script src="static/js/ace-extra.min.js"></script>
        <!--[if lte IE 8]>
        <script src="static/js/html5shiv.js"></script>
        <script src="static/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
         <div class="navbar navbar-default navbar-fixed-top h-navbar">
            <div class="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="structure/arm_kis" class="navbar-brand">
                        <small>Полномочия, услуги и функции Санкт-Петербурга</small>
                    </a>
                    <a href="structure/arm_kis" class="navbar-brand">
                        <small></small>
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right">
                    <ul class="ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span>Навигация</span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-blue dropdown-caret dropdown-close">
                                <li><a href="structure/arm_iogv">Полномочия</a></li>
                                <li class="divider"></li>
                                <li><a href="structure/chernovik">Черновики</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Реестр услуг и функций</a></li>
                                <li class="divider"></li>
                                <li><a href="structure/journal">Журнал изменений</a></li>
                            </ul>
                        </li>
                        <li class="purple">
                            <a href="structure/uvedoml">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="badge badge-important">4</span>
                            </a>
                        </li>
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small>Добро пожаловать,</small>
                                    Сотрудник
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu dropdown-menu-right dropdown-blue dropdown-caret dropdown-close">
                                <li><a href="#"><i class="ace-icon fa fa-cogs"></i>Настройки</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="ace-icon fa fa-power-off"></i>Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
                        <!-- step 2 -->
                    </div>

                    <div class="step-pane" id="step3">
                    <!-- step 3 -->
                    </div>

                    <div class="step-pane" id="step4">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <h3 class="center">
                                    Согласовывать результаты технических обследований централизованных систем горячего водоснабжения, 
                                    холодного водоснабжения и водоотведения
                                </h3>
                                <table class="table table-striped">
                                    <tr>
                                        <td>ID</td>
                                        <td>4676529876</td>
                                    </tr>
                                    <tr>
                                        <td>Реквизиты постановления</td>
                                        <td>Постановление Правительства Санкт-Петербурга от 29.11.2013 № 940 "О мерах по реализации Закона Санкт-Петербурга "О разгранисении полномочий органов государственной власти Санкт-Петербурга в сфере водоснабжения и водоотведения"</td>
                                    </tr>
                                    <tr>
                                        <td>Ответственный орган</td>
                                        <td>Комитет по энергетике и инженерному обеспечению</td>
                                    </tr>
                                    <tr>
                                        <td>Статус</td>
                                        <td><p style="color:green">КИС согласовал разграничение</p></td>
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
                                                <li><a href="#usl_1" data-toggle="tab">Услуга 1</a></li>
                                                <li><a href="#func_1" data-toggle="tab">Функция 1</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main padding-16">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="usl_1">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>Статус</td>
                                                                <td><p style='color:red'>АР ожидает согласования Юридического комитета</p></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Полное наименование</td>
                                                                <td>Согласовывать результаты технических обследований централизованных систем горячего водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Краткое наименование</td>
                                                                <td>Согласовывать результаты технических обследований централизованных систем горячего водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Сфера</td>
                                                                <td>Природопользование и экология</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Услугу оказывает</td>
                                                                <td>Администрации районов Санкт-Петербурга</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Результат предоставления</td>
                                                                <td>Согласование (отказ в согласовании) результатов обследований централизованных систем водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Срок предоставления</td>
                                                                <td>Не более 3 дней с момента подачи заявления</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Категория заявителей</td>
                                                                <td>Юридические лица и их представители</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Способ предоставления</td>
                                                                <td>В традиционном порядке, через МФЦ</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Краткое описание</td>
                                                                <td>Услуга заключается в.....</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История согласований услуги</button></a>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="func_1">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                            <tr>
                                                                <td>Статус</td>
                                                                <td>АР ожидает согласования Юридического комитета</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Полное наименование</td>
                                                                <td>Согласовывать результаты технических обследований централизованных систем горячего водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Краткое наименование</td>
                                                                <td>Согласовывать результаты технических обследований централизованных систем горячего водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Сфера</td>
                                                                <td>Природопользование и экология</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Услугу оказывает</td>
                                                                <td>Администрации районов Санкт-Петербурга</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Результат предоставления</td>
                                                                <td>Согласование (отказ в согласовании) результатов обследований централизованных систем водоснабжения</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Срок предоставления</td>
                                                                <td>Не более 3 дней с момента подачи заявления</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Категория заявителей</td>
                                                                <td>Юридические лица и их представители</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Способ предоставления</td>
                                                                <td>В традиционном порядке, через МФЦ</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Краткое описание</td>
                                                                <td>Услуга заключается в.....</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="row">
                                                        <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История согласований функции</button></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <button class="btn btn-grey btn-sm pull-right" id="change_btn">Изменить</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="who_changes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="row">
                                <h4 class="center">Выбирете вносящего изменения</h4>
                            </div>
                            <hr>
                            <form name="change_form">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <select id="select_who_changes" name="select_who_changes" class="input-xxlarge">
                                            <option selected value="КИС">КИС
                                            <option>...
                                            <option>...
                                            <option>...
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div id="info_for_iogv">
                                    <div class="row">
                                        <h5 class="center">Комментарий</h5>
                                        <div class="col-md-10 col-md-offset-1">
                                            <textarea class="col-md-12" name="change_com_4_1"></textarea>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <label for="answer_date">Дата ответа</label>
                                            <input id="answer_date" name="answer_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="space-6"></div>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <input type="submit" class="btn btn-info btn-sm pull-right" value="Подтвердить">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        
        <!--[if !IE]> -->
        <script src="static/js/jquery.min.js" type="text/javascript"></script>
        <!-- <![endif]-->
        <!--[if lte IE 9>
        <script src="static/js/jqueryix.min.js" type="text/javascript"></script>
        <![endif]-->
        <script src="static/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="static/js/fuelux.wizard.min.js"></script>
        <script src="static/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="static/js/ace-elements.min.js" type="text/javascript"></script>
        <script src="static/js/ace.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#my-wizard')
            .ace_wizard({
                step: 4 
            }).on('stepclick', function(e) {
                e.preventDefault();
            });
            $('#info_for_iogv').hide();
            $('#change_btn').on('click',function(){$('#who_changes').modal();});
            $('#select_who_changes').on('change',function()
            {
                if (document.getElementById('select_who_changes').value!=='КИС'){$('#info_for_iogv').show();}
                else {$('#info_for_iogv').hide();}
            });
            $('#answer_date').datepicker({
                autoclose:true,
                todayHiglight:true
            });
        </script>
    </body>
</html>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>" />
        <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace-fonts.css" type="text/css" rel="stylesheet" />
        <link href="static/css/datepicker.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace.min.css" type="text/css" rel="stylesheet" />
        <!--[if lte IE 9>
        <link href="static/css/ace-part2.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 9>
        <link href="static/css/ace-ie.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <script src="static/js/ace-extra.min.js" type="text/javascript"></script>
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
                                <li><a href="structure/arm_kis">Полномочия</a></li>
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
                            <span class="title">Разграничение полномочия</span>
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
                    <div class="step-pane active" id="step1">
                        <form class="form-horizontal" role="form">
                            <fieldset>
                                <div class="col-md-offset-1">
                                    <h4 class="col-md-10 center">Добавление нового полномочия</h4>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="name_iogv" class="control-label col-md-5">Наименование полномочия в соответствии с Положением об ИОГВ</label>
                                            <textarea id="name_iogv" class="col-md-5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="changes_in_pol" class="control-label col-md-5">Внесены изменения в Положение об ИОГВ (реквизиты НПА)</label>
                                            <textarea id="changes_in_pol" class="col-md-5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="punkt_iogv" class="control-label col-md-5">№ пункта в Положении об ИОГВ</label>
                                            <input type="text" id="punkt_iogv" class="col-md-5">
                                        </div>
                                        <div class="form-group">
                                            <label for="isp_is" class="control-label col-md-5">Полномочие осуществляется с использованием ИС</label>
                                            <textarea id="isp_is" class="col-md-5"></textarea>
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
                                                <select id="select_org" class="col-md-5">
                                                    <option>Архивный комитет</option>
                                                    <option>Комитет по образованию</option>
                                                    <option>Комитет по здравоохранению</option>
                                                    <option>Комитет по социальной политике Санкт-Петербурга</option>
                                                </select>
                                            </div>
                                            <div class="form-group pull-right">
                                                <label class="control-label" for="srok_otveta">Установите срок ответа</label>
                                                <input type="text" id="srok_otveta">
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
        
        <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form name="step1_com" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="input-xxlarge center" name="comment_st1"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <a href="structure/step2"><button type="submit" class="btn btn-primary">Отправить</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--[if !IE]> -->
        <script src="static/js/jquery.min.js" type="text/javascript"></script>
        <!-- <![endif]-->
        <!--[if lte IE 9>
        <script src="static/js/jquery1x.min.js" type="text/javascript"></script>
        <![endif]-->
        <script src="static/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="static/js/fuelux.wizard.min.js" type="text/javascript"></script>
        <script src="static/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="static/js/ace-elements.min.js" type="text/javascript"></script>
        <script src="static/js/ace.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#my-wizard')
            .ace_wizard();
            $('#step1_file').ace_file_input({
                no_file: "Присоединить файл",
                btn_choose:"Выбрать",
                btn_change:"Изменить",
                enable_reset: true
            });
            $('#srok_otveta').datepicker({
                autoclose:true,
                todayHiglight:true
            });
        </script>
    </body>
</html>

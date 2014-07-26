<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>" />
        <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace-fonts.css" type="text/css" rel="stylesheet" />
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
                    <a href="#" class="navbar-brand">
                        <small>Полномочия, услуги и функции Санкт-Петербурга</small>
                    </a>
                    <a href="#" class="navbar-brand">
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
                                <li><a href="#">Полномочия</a></li>
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
            <div class="col-md-10 col-md-offset-1">
                <!-- Timeline -->
                <div class="timeline-container">

                    <div class="timeline-label">
                        <span class="label label-primary arrowed-in-right label-lg">
                            <b>Сегодня</b>
                        </span>
                    </div>
                    <div class="timeline-items">
                        
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label label-info label-sm">Комитет по</span>
                            </div>
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">Комитету по <span class="grey">Тема комментария</span></h5>
                                    <span class="widget-toolbar no-border">
                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                         16:22
                                    </span>
                                    <span class="widget-toolbar">
                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        Тело комментария.
                                        <div class="space-6"></div>
                                        <div class="widget-toolbox clearfix">
                                            <div class="pull-right action-buttons">
                                                <a href="#"><i class="ace-icon fa fa-pencil-square blue bigger-125"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label label-info label-sm">Комитет по</span>
                            </div>
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">Комитету по <span class="grey">Тема комментария</span></h5>
                                    <span class="widget-toolbar no-border">
                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                         15:12
                                    </span>
                                    <span class="widget-toolbar">
                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        Тело комментария.
                                        <div class="space-6"></div>
                                        <div class="widget-toolbox clearfix">
                                            <div class="pull-right action-buttons">
                                                <a href="#"><i class="ace-icon fa fa-pencil-square blue bigger-125"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="timeline-label">
                        <span class="label label-success arrowed-in-right label-lg">
                            <b>Вчера</b>
                        </span>
                    </div>
                    <div class="timeline-items">
                        
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label label-info label-sm">Комитет по</span>
                            </div>
                            <div class="widget-box widget-color-red">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">Комитету по <span class="grey">Тема комментария</span></h5>
                                    <span class="widget-toolbar no-border">
                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                         14:37
                                    </span>
                                    <span class="widget-toolbar">
                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        Тело комментария.
                                        <div class="space-6"></div>
                                        <div class="widget-toolbox clearfix">
                                            <div class="pull-right action-buttons">
                                                <a href="#"><i class="ace-icon fa fa-pencil-square blue bigger-125"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item clearfix">
                            <div class="timeline-info">
                                <span class="label label-info label-sm">Комитет по</span>
                            </div>
                            <div class="widget-box transparent">
                                <div class="widget-header widget-header-small">
                                    <h5 class="widget-title smaller">Комитету по <span class="grey">Тема комментария</span></h5>
                                    <span class="widget-toolbar no-border">
                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                         11:55
                                    </span>
                                    <span class="widget-toolbar">
                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        Тело комментария.
                                        <div class="space-6"></div>
                                        <div class="widget-toolbox clearfix">
                                            <div class="pull-right action-buttons">
                                                <a href="#"><i class="ace-icon fa fa-pencil-square blue bigger-125"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script src="static/js/ace-elements.min.js" type="text/javascript"></script>
        <script src="static/js/ace.min.js" type="text/javascript"></script>
    </body>
</html>

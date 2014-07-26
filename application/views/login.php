<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>" />
        <link href="static/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ace-fonts.css" type="text/css" rel="stylesheet" />
        <link href="static/css/ui.jqgrid.css" type="text/css" rel="stylesheet" />
        <link href="static/css/searchFilter.css" type="text/css" rel="stylesheet" />
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

    <body class="login-layout blur-login">
        <div class="main-container">
            <div class="main-content">
                
                <div class="row" align="center">
                    <img src="static/img/logo.png">
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="login-container">
                                <div class="space-6"></div>
                                    <div class="space-6"></div>
                                    <div class="position-relative">
                                        <div id="login-box" class="login-box visible widget-box no-border">
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <h4 class="header blue lighter bigger">
                                                        <i class="ace-icon fa fa-home"></i>
                                                        Выполните вход в систему
                                                    </h4>
                                                    <div class="space-6"></div>
                                                    <form action="structure/login" method="post">
                                                            <fieldset>
                                                                <label class="block clearfix">
                                                                    <span class="block input-icon input-icon-right">
                                                                        <input class="form-control" id="login_name" name="login_name" maxlength="50" placeholder="Имя пользователя">
                                                                        <i class="ace-icon fa fa-user"></i>
                                                                    </span>
                                                                </label>
                                                                    <label class="block clearfix">
                                                                        <span class="block input-icon input-icon-right">
                                                                            <input class="form-control" id="password" type="password" maxlength="50" placeholder="Пароль">
                                                                            <i class="ace-icon fa fa-lock"></i>
                                                                        </span>
                                                                    </label>
                                                                    <div class="space"></div>
                                                                    <div class="clearfix">
                                                                        
                                                                            <button type="submit" id="log" class="width-35 pull-right btn btn-md btn-primary">
                                                                                <i class="ace-icon fa fa-key"></i>
                                                                                <span class="bigger-110">Вход</span>
                                                                            </button>
                                                                       
                                                                    </div>
                                                                    <div class="space-4"></div>
                                                            </fieldset>
                                                        </form>
                                                    <div class="space-6"></div>
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
        <script src="static/js/jquery.jqGrid.min.js"></script>
        <script src="static/js/grid.locale-ru.js"></script>
        <script src="static/js/grid.setcolumns.js"></script>
        <script src="static/js/ace-elements.min.js" type="text/javascript"></script>
        <script src="static/js/ace.min.js" type="text/javascript"></script>

    </body>
</html>

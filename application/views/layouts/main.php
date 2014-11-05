<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo base_url(); ?>" />
        <?$this->carabiner->empty_cache();?>
        <?$this->carabiner->display('site', 'css');?>
        
        <!--[if lte IE 9>
        <link href="static/css/ace-part2.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 9>
        <link href="static/css/ace-ie.min.css" type="text/css" rel="stylesheet" />
        <![endif]-->
        <!--[if lte IE 8]>
        <script src="static/js/html5shiv.js"></script>
        <script src="static/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <script type="text/javascript">
            var _options = {
                'page':'<?=$this->router->fetch_class()?>/<?=$this->router->fetch_method()?>',
                'baseURL':'<?=base_url()?>'
            };
        </script>
        <?$this->carabiner->display('site', 'js')?>
        <div class="navbar navbar-default navbar-fixed-top h-navbar">
            <div class="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="structure/arm_kis" class="navbar-brand">
                        <small><?= $this->session->userdata('organization_name')?></small>
                    </a>
                    <a href="structure/arm_kis" class="navbar-brand">
                        <small></small>
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span>Навигация</span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-blue dropdown-caret dropdown-close">
                                <li><a href="structure/reestr">Полномочия</a></li>
                               <!-- <li class="divider"></li>
                                <li><a href="structure/chernovik">Черновики</a></li>
                                -->
                                <li class="divider"></li>
                                <li><a href="structure/journal">Журнал изменений</a></li>
                            </ul>
                        </li>
                        <li class="light-blue">
                            <a href="structure/uvedoml">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="badge badge-important"><?=isset($this->notifications_size)?$this->notifications_size:0?></span>
                            </a>
                        </li>
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    Добро <br>пожаловать
                                   
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu dropdown-menu-right dropdown-blue dropdown-caret dropdown-close">
                                <?php echo $this->session->userdata('user_type')==1?'<li><a href="settings/index"><i class="ace-icon fa fa-cogs"></i>Настройки</a></li><li class="divider"></li>':'';
                                        ?>
                                
                                <li><a href="<?=site_url('/logout')?>"><i class="ace-icon fa fa-power-off"></i>Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?=$content?>
        
    </body>
</html>

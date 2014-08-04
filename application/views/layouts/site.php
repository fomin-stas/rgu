<html lang="en">
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

    <body class="login-layout blur-login">
        <?=$content?>
        <script type="text/javascript">
            var _options = {
                'page':'<?=$this->router->fetch_class()?>/<?=$this->router->fetch_method()?>',
                'baseURL':'<?=base_url()?>'
            };
        </script>
        <?$this->carabiner->display('site', 'js')?>

    </body>
</html>

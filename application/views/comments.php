<html>
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
    <body>
        <div class="navbar navbar-default navbar-fixed-top h-navbar">
            <div class="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>Полномочия, услуги и функции Санкт-Петербурга</small>
                    </a>
                    <a href="#" class="navbar-brand">
                        <small>Комментари</small>
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
            <div class="col-md-12">
                <div class="ui-jqgrid ui-corner-all">
                    <table id="grid-table"></table>
                </div>
                <div id="grid-pager"></div>
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
        <script type="text/javascript">
            var grid_data = 
            [ 
                    {from:"Комитет по...",to:"Комитет по...",in_com:'01.02.2014 15:03:21 Комментарий, на который <hr> пользователь отвечает',out_com:"01.02.2014 15:03:21 Комментарий пользователя в ответ на его комментарий",operate:"Ответить"}
            ];

            jQuery(function($) {
                    var grid_selector = "#grid-table";
                    var pager_selector = "#grid-pager";

                    //resize to fit page size
                    $(window).on('resize.jqGrid', function () {
                            $(grid_selector).jqGrid( 'setGridWidth', $(".page-container").width() );
                })
                    //resize on sidebar collapse/expand
                    var parent_column = $(grid_selector).closest('[class*="col-"]');
                    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
                            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                                    $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
                            }
                })



                    jQuery(grid_selector).jqGrid({
                            altRows: true,
                            data: grid_data,
                            datatype: "local",
                            height: 700,
                            colNames:['От кого','Кому','Входящий комментарий', 'Исходящий комментарий', 'Операции'],
                            colModel:[
                                    {name:'from',index:'from', sortable:true, editable: false, fixed:true},
                                    {name:'to',index:'to', sortable:true, editable:false, fixed:true},
                                    {name:'in_com',index:'in_com', editable: false, fixed:true},
                                    {name:'out_com',index:'out_com', editable: false, fixed:true},
                                    {name:'operate',index:'operate', sortable:true, editable: false, fixed:true}
                            ], 

                            viewrecords : true,
                            rowNum:10,
                            rownumbers:true,
                            rowList:[10,20,30],
                            pager : pager_selector,

                            multiselect: true,

                    multiboxonly: true,

                            loadComplete : function() {
                                    var table = this;
                                    setTimeout(function(){
                                            styleCheckbox(table);

                                            updateActionIcons(table);
                                            updatePagerIcons(table);
                                            enableTooltips(table);
                                    }, 0);
                            },

                            editurl: "/",//nothing is saved
                            caption: "Таблица комментариев"


                    });
                    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size



                    //enable search/filter toolbar
                    jQuery(grid_selector).jqGrid('filterToolbar',{searchOnEnter: false, enableClear: false,stringResult:true});



                    //switch element when editing inline
                    function aceSwitch( cellvalue, options, cell ) {
                            setTimeout(function(){
                                    $(cell) .find('input[type=checkbox]')
                                            .addClass('ace ace-switch ace-switch-5')
                                            .after('<span class="lbl"></span>');
                            }, 0);
                    }
                    //enable datepicker
                    function pickDate( cellvalue, options, cell ) {
                            setTimeout(function(){
                                    $(cell) .find('input[type=text]')
                                                    .datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
                            }, 0);
                    }


                    //navButtons
                    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
                            { 	//navbar options
                                    edit: false,
                                    editicon : 'ace-icon fa fa-pencil blue',
                                    add: false,
                                    addicon : 'ace-icon fa fa-plus-circle purple',
                                    del: false,
                                    delicon : 'ace-icon fa fa-trash-o red',
                                    search: true,
                                    searchicon : 'ace-icon fa fa-search orange',
                                    refresh: true,
                                    refreshicon : 'ace-icon fa fa-refresh green',
                                    view: true,
                                    viewicon : 'ace-icon fa fa-search-plus grey',
                            },
                            {
                                    width: 450,
                                    recreateForm: true,
                                    beforeShowForm : function(e) {
                                            var form = $(e[0]);
                                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                            style_edit_form(form);
                                    }
                            },
                            {
                                    //new record form
                                    width: 450,
                                    recreateForm: true,
                                    viewPagerButtons: false,
                                    beforeShowForm : function(e) {
                                            var form = $(e[0]);
                                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                                            .wrapInner('<div class="widget-header" />')
                                            style_edit_form(form);
                                    }
                            },
                            {
                                    //delete record form
                                    recreateForm: true,
                                    beforeShowForm : function(e) {
                                            var form = $(e[0]);
                                            if(form.data('styled')) return false;

                                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                                            style_delete_form(form);

                                            form.data('styled', true);
                                    },
                                    onClick : function(e) {
                                            alert(1);
                                    }
                            },
                            {
                                    //search form
                                    width:850,
                                    recreateForm: true,
                                    afterShowSearch: function(e){
                                            var form = $(e[0]);
                                            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                                            style_search_form(form);
                                    },
                                    afterRedraw: function(){
                                            style_search_filters($(this));
                                    }
                                    ,
                                    multipleSearch: true,
                            },
                            {
                                    //view record form
                                    width:700,
                                    recreateForm: true,
                                    beforeShowForm: function(e){
                                            var form = $(e[0]);
                                            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
                                    }
                            }
                    );
                
                    //to Excel
                    jQuery("#grid-table").jqGrid('navGrid',"#grid-pager").jqGrid('navButtonAdd',"#grid-pager",
                    {
                        id:"#to_excel_btn",
                        buttonicon:"ace-icon fa fa-external-link red",
                        caption:"",
                        title:"Выгрузить в Excel"

                    });


                    function style_edit_form(form) {
                            var buttons = form.next().find('.EditButton .fm-button');
                            buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
                            buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
                            buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>');

                            buttons = form.next().find('.navButton a');
                            buttons.find('.ui-icon').hide();
                            buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
                            buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');		
                    }

                    function style_delete_form(form) {
                            var buttons = form.next().find('.EditButton .fm-button');
                            buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
                            buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
                            buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
                    }

                    function style_search_filters(form) {
                            form.find('.delete-rule').val('X');
                            form.find('.add-rule').addClass('btn btn-xs btn-primary');
                            form.find('.add-group').addClass('btn btn-xs btn-success');
                            form.find('.delete-group').addClass('btn btn-xs btn-danger');
                    }
                    function style_search_form(form) {
                            var dialog = form.closest('.ui-jqdialog');
                            var buttons = dialog.find('.EditTable')
                            buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
                            buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
                            buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
                    }

                    function beforeDeleteCallback(e) {
                            var form = $(e[0]);
                            if(form.data('styled')) return false;

                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                            style_delete_form(form);

                            form.data('styled', true);
                    }

                    function beforeEditCallback(e) {
                            var form = $(e[0]);
                            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                            style_edit_form(form);
                    }

                    function styleCheckbox(table) {

                    }



                    function updateActionIcons(table) {

                    }

                    //replace icons with FontAwesome icons
                    function updatePagerIcons(table) {
                            var replacement = 
                            {
                                    'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                                    'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                                    'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                                    'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
                            };
                            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                                    var icon = $(this);
                                    var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                                    if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
                            })
                    }

                    function enableTooltips(table) {
                            $('.navtable .ui-pg-button').tooltip({container:'body'});
                            $(table).find('.ui-pg-div').tooltip({container:'body'});
                    }


            });
        </script>
    </body>
</html>

      <div class="main-container">
            <div class="tabbable col-md-12" id="gridTabs">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li>
                        <a href="#new_authorities" data-toggle="tab">Новые согласования (<?=count($grid_data['new_authorities'])-1?>)</a>
                    </li>
                    <li>
                        <a href="#in_working" data-toggle="tab">Полномочия в работе (<?=count($grid_data['in_working'])-1?>)</a>
                    </li>
                    <li>
                        <a href="#in_process" data-toggle="tab">Исполняемые (<?=count($grid_data['in_process'])-1?>)</a>
                    </li>
                    <li  class="active">
                        <a href="#all" data-toggle="tab">Полный перечень (<?=count($grid_data['all'])?>)-1</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="new_authorities">
                        <div class="ui-jqgrid ui-corner-all">
                            <table id="grid-table-new_authorities" class="grid-table"></table>
                        </div>
                        <div id="grid-pager-new_authorities" class="grid-pager"></div>
                    </div>
                    <div class="tab-pane" id="in_working">
                        <div class="ui-jqgrid ui-corner-all">
                            <table id="grid-table-in_working" class="grid-table"></table>
                        </div>
                        <div id="grid-pager-in_working" class="grid-pager"></div>
                    </div>
                    <div class="tab-pane" id="in_process">
                        <div class="ui-jqgrid ui-corner-all">
                            <table id="grid-table-in_process" class="grid-table"></table>
                        </div>
                        <div id="grid-pager-in_process" class="grid-pager"></div>
                    </div>
                    <div class="tab-pane in active" id="all">
                        <div class="ui-jqgrid ui-corner-all">
                            <table id="grid-table-all" class="grid-table"></table>
                        </div>
                        <div id="grid-pager-all" class="grid-pager"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="info_polnomoch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h3 class="center">
                                Обеспечивать в пределах компетенции Комитета выполнение федеральных программ, 
                                в реализации которых участвует Санкт-Петербург, а также программ развития Санкт-Петербурга.
                            </h3>
                            <table class="table table-striped">
                                <tr>
                                    <td>ID</td>
                                    <td>4564567</td>
                                </tr>
                                <tr>
                                    <td>Наименование полномочия в соответствии с Положением об ИОГВ</td>
                                    <td>
                                        Обеспечивать в пределах компетенции Комитета выполнение федеральных программ, 
                                        в реализации которых участвует Санкт-Петербург, а также программ развития Санкт-Петербурга.
                                    </td>
                                </tr>
                                <tr>
                                    <td>Внесены изменения в Положение об ИОГВ (реквизиты НПА)</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>№ пункта в Положении об ИОГВ:</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Полномочие осуществляется с использованием ИС</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Ответственный орган</td>
                                    <td>Архивный комитет</td>
                                </tr>
                                <tr>
                                    <td>Статус</td>
                                    <td><p style="color:green">КИС согласовал разграничение</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="structure/history_polnomoch"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="info_usl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h4 class="center">Услуга 4564571</h4>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Полное наименование</td>
                                        <td>Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург</td>
                                    </tr>
                                    <tr>
                                        <td>Краткое наименование</td>
                                        <td>Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург</td>
                                    </tr>
                                    <tr>
                                        <td>Сфера</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Услугу оказывает</td>
                                        <td>Архивный комитет</td>
                                    </tr>
                                    <tr>
                                        <td>Результат предоставления</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Срок предоставления</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Категория заявителей</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Способ предоставления</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Краткое описание</td>
                                        <td>Услуга заключается в.....</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="info_func" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h4 class="center">Функция 4564570</h4>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Наименование</td>
                                        <td>Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург</td>
                                    </tr>
                                    <tr>
                                        <td>Выполняемые действия</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Органы, в отношении которых выполняются действия</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Организации, принимающие участие в исполнении функции</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Результат исполнения функции</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>необходимость формирования отчетности</td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
                <div class="modal fade" id="changes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h4 class="center">
                                История изменений
                                <input type="text" id="timeline_search_input" class="pull-right input-sm">
                                <i class="ace-icon fa fa-search nav-search-icon pull-right"></i>
                            </h4>
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
                                        <div class="widget-box widget-color-blue">
                                            <div class="widget-header widget-header-small">
                                                <h5 class="widget-title smaller"><span class="grey"></span></h5>
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
                                                    Текущее значение
                                                    <div class="space-6"></div>
                                                    <div class="widget-toolbox clearfix">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item clearfix">
                                        <div class="timeline-info">
                                            <span class="label label-info label-sm">Комитет по</span>
                                        </div>
                                        <div class="widget-box widget-color-purple">
                                            <div class="widget-header widget-header-small">
                                                <h5 class="widget-title smaller">Изменено</h5>
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
                                                    Предыдущее значение
                                                    <div class="space-6"></div>
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
                                        <div class="widget-box widget-color-purple">
                                            <div class="widget-header widget-header-small">
                                                <h5 class="widget-title smaller">Изменено</h5>
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
                                                    Предыдущее значение
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
            </div>
        </div>
        
        <script type="text/javascript">
            var data = <?=json_encode($grid_data)?>,
                column_models = <?=$column_models?>,
                column_names = <?=$column_names?>;
            jQuery(function($) {
                var grid_data = data.all;
                var grid_selector = "#grid-table-all";
                var pager_selector = "#grid-pager-all";
                var text_link; //link cellcontent, must changes dynamicaly 
                var myDefaultSearch = "cn";
                    console.log(data);
                // Tabs init
                $('#gridTabs .nav-tabs a:last').tab('show');
                $('#gridTabs .nav-tabs a').click(function (e) {
                  e.preventDefault();
                  $(this).tab('show');
                    var tab_hash = e.target.hash.replace('#', '');
                    var grid_selector = "#grid-table-"+tab_hash;
                    var pager_selector = "#grid-pager-"+tab_hash;
                    var grid_data = eval('data.'+tab_hash);

                    Structure.renderGrid(grid_selector, pager_selector, grid_data);
                });

                    //resize to fit page size
                    $(window).on('resize.jqGrid', function () {
                            $(grid_selector).jqGrid( 'setGridWidth', $(".page-container").width() );
                });
                    //resize on sidebar collapse/expand
                    var parent_column = $(grid_selector).closest('[class*="col-"]');
                    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
                            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                                    $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
                            }
                });

                    Structure.renderGrid(grid_selector, pager_selector, grid_data);
                    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

					$('.ui-pg-div .ui-icon.ace-icon.fa.fa-plus-circle.purple').remove();

                    //enable search/filter toolbar
                    jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch: myDefaultSearch,searchOnEnter: false, enableClear: true,stringResult:true});



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


                    
                    
            });
            
           
            $(document).contextmenu(
            {
                delegate:"td[role='gridcell']",
                menu:
                    [
                {title:"Подробная информация",action:function(event,ui)
                    {
                        if (ui.target[0].className=='cell_div_func'){$('#info_func').modal();}
                        else if (ui.target[0].className=='cell_div_usl'){$('#info_usl').modal();}
                        else if (ui.target[0].className=='cell_div_nadz'){$('#info_nadz').modal();}
                        else {$('#info_polnomoch').modal();}
                    }
                },
                {title:"История изменений",action:function(event,ui){$("#changes").modal();}}
                    ]
            });
        </script>

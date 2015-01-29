
<div class="main-container">
    <div class="tabbable col-md-12" id="gridTabs">
        <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
            <li>
                <a href="#new_authorities" data-toggle="tab">Новые согласования (<?= $authority_sizes['new_authorities'] ?>)</a>
            </li>
            <li>
                <a href="#in_working" data-toggle="tab">Полномочия в работе (<?= $authority_sizes['in_working'] ?>)</a>
            </li>
            <li>
                <a href="#in_process" data-toggle="tab">Исполняемые (<?= $authority_sizes['in_process'] ?>)</a>
            </li>
            <li  class="active">
                <a href="#all" data-toggle="tab">Полный перечень (<?= $authority_sizes['all'] ?>)</a>
            </li>
            <lable class="col-xs-5 pull-right" style="font-size:16">Техническая поддержка: тел: 417-36-37; e-mail: arm-iogv@iac.spb.ru</lable>
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
    var data = <?= json_encode($grid_data, true) ?>,
            column_models = <?= $column_models ?>,
            column_names = <?= $column_names ?>;
    jQuery(function ($) {
        //switch element when editing inline
        function aceSwitch(cellvalue, options, cell) {
            setTimeout(function () {
                $(cell).find('input[type=checkbox]')
                        .addClass('ace ace-switch ace-switch-5')
                        .after('<span class="lbl"></span>');
            }, 0);
        }
        //enable datepicker
        function pickDate(cellvalue, options, cell) {
            setTimeout(function () {
                $(cell).find('input[type=text]')
                        .datepicker({format: 'yyyy-mm-dd', autoclose: true});
            }, 0);
        }




    });


    $(document).contextmenu(
            {
                delegate: "td[role='gridcell']",
                menu:
                        [
                            {title: "Подробная информация", action: function (event, ui)
                                {
                                    if (ui.target[0].className == 'cell_div_func') {
                                        $('#info_func').modal();
                                    }
                                    else if (ui.target[0].className == 'cell_div_usl') {
                                        $('#info_usl').modal();
                                    }
                                    else if (ui.target[0].className == 'cell_div_nadz') {
                                        $('#info_nadz').modal();
                                    }
                                    else {
                                        $('#info_polnomoch').modal();
                                    }
                                }
                            },
                            {title: "История изменений", action: function (event, ui) {
                                    $("#changes").modal();
                                }}
                        ]
            });
    $(window).load(function () {
        $('.ui-search-toolbar').removeClass('ui-search-toolbar');
    });
</script>

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

<div class="modal fade" id="changes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div class="modal fade" id="textarea_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Редактирование</h4>
            </div>
            <div class="modal-body" id="">

            </div>
            <div class="modal-footer">

                <button type="button" id="textarea_change" class="btn btn-info btn-sm pull-right">Изменить</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    var data = <?= json_encode($grid_data, true) ?>,
            column_models = <?= $column_models ?>,
            column_names = <?= $column_names ?>;
    jQuery(function ($) {

//*****************************************инициализация дерева
        DataSourceTree = function (options) {
            this._data = options.data;
            this._delay = options.delay;
        }

        DataSourceTree.prototype.data = function (options, callback) {
            var self = this;
            var $data = null;

            if (!("name" in options) && !("type" in options)) {
                $data = this._data;//the root tree
                callback({data: $data});
                return;
            }
            else if ("type" in options && options.type == "folder") {
                if ("additionalParameters" in options && "children" in options.additionalParameters)
                    $data = options.additionalParameters.children;
                else
                    $data = {}//no data
            }

            if ($data != null)//this setTimeout is only for mimicking some random delay
                setTimeout(function () {
                    callback({data: $data});
                }, parseInt(Math.random() * 500) + 200);

            //we have used static data here
            //but you can retrieve your data dynamically from a server using ajax call
            //checkout examples/treeview.html and examples/treeview.js for more info
        };

        $(document).on('click', '.tree_span', function() {
            var id = $(this).data('id');
            $('.content_tree').hide();
            $('#' + id).show();
        });
//************************************************************************************** 


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
                            /*{title: "Подробная информация", action: function (event, ui)
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
                             },*/
                            {title: "Редактировать", action: function (event, ui) {
                                    var rowId = getClickedRowId(event, ui),
                                            // get row data
                                            rowData = $(Structure.options.grid_selector).jqGrid("getGridParam", "data")[rowId - 1],
                                            // get cell name by grid selector
                                            cellName = ui.target[0].getAttribute('aria-describedby').replace(Structure.options.grid_selector.replace('#', '') + '_', '');

                                    $.ajax({
                                        url: 'ajax/get_service_full_property',
                                        type: 'POST',
                                        data: {
                                            rowId: rowId,
                                            collIndex: getClickedColNum(event, ui),
                                            cellName: cellName,
                                            authority_id: rowData['id_authority']
                                        },
                                        success: function (data)
                                        {
                                            console.log(data);
                                            $('#textarea_edit').html(data);
                                            $('#textarea_edit').modal('show');
                                        }
                                    });

                                    
                                    //jQuery(Structure.options.grid_selector).jqGrid('editGridRow', getClickedRowId(event, ui), {width: 450});
                                }},
                            {title: "История изменений", action: function (event, ui)
                                {
                                    var rowId = getClickedRowId(event, ui),
                                            // get row data
                                            rowData = $(Structure.options.grid_selector).jqGrid("getGridParam", "data")[rowId - 1],
                                            // get cell name by grid selector
                                            cellName = ui.target[0].getAttribute('aria-describedby').replace(Structure.options.grid_selector.replace('#', '') + '_', '');

                                    $.ajax({
                                        url: 'ajax/get_history_cell',
                                        type: 'POST',
                                        data: {
                                            rowId: rowId,
                                            collIndex: getClickedColNum(event, ui),
                                            cellName: cellName,
                                            authority_id: rowData['id_authority'],
                                        },
                                        success: function (data)
                                        {
                                            $('#changes').html(data);
                                        }
                                    });
                                    $("#changes").modal();
                                }
                            }
                        ]
            });


    function getClickedRowId(event, ui) //get id of the clicked row
    {
        var rowid;
        if (ui.target[0].parentNode.nodeName == 'TR')
        {
            rowid = ui.target[0].parentNode.id;
        }
        else if (ui.target[0].parentNode.parentNode.nodeName == 'TR')
        {
            rowid = ui.target[0].parentNode.parentNode.id;
        }
        else {
            return false;
        }
        return rowid;
    }

    function getClickedColNum(event, ui) //get clicked td index in tr
    {
        var cellid;
        var currentRow;
        currentRow = $('#' + getClickedRowId(event, ui) + ' td');
        for (var i = 0; i <= currentRow.length; i++)
        {
            if (ui.target[0] == currentRow[i] | ui.target[0].parentNode == currentRow[i]) {
                cellid = i;
            }
        }
        return cellid;
    }
    $(window).load(function () {
        $('.ui-search-toolbar').removeClass('ui-search-toolbar');
    });

</script>

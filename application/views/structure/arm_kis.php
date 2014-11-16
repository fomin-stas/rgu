        <div class="main-container">
            <div class="tabbable col-md-12" id="gridTabs">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li>
                        <a href="#new_authorities" data-toggle="tab">Новые согласования (<?=$authority_sizes['new_authorities']?>)</a>
                    </li>
                    <li>
                        <a href="#in_working" data-toggle="tab">Полномочия в работе (<?=$authority_sizes['in_working']?>)</a>
                    </li>
                    <li>
                        <a href="#in_process" data-toggle="tab">Исполняемые (<?=$authority_sizes['in_process']?>)</a>
                    </li>
                    <li  class="active">
                        <a href="#all" data-toggle="tab">Полный перечень (<?=$authority_sizes['all']?>)</a>
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
                        <div class="col-md-10 col-md-offset-1">
                            <a href="structure/history_polnomoch"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                    <div class="space-6"></div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="info_usl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h3 class="center">Услуга 4564571</h3>
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
                        <div class="col-md-10 col-md-offset-1">
                            <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                    <div class="space-6"></div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="info_func" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h3 class="center">Функция 4564570</h3>
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
                        <div class="col-md-10 col-md-offset-1">
                            <a href="structure/history_usl_func"><button class="btn btn-info btn-sm pull-right">История изменений</button></a>
                        </div>
                    </div>
                    <div class="space-6"></div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="changes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
        
		<div class="modal fade" id="multiselect_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Редактирование</h4>
                    </div>
                    <div class="modal-body">
<!--
                        <div class="row">
                            <select class="mselect_select" id="mselect_select"></select>
                            <button type="button" id="mselect_add" class="btn btn-info btn-sm">Добавить</button>
                        </div>
                        <hr>
-->
                        <div class="row">
                            <textarea id="mselect_textarea" class="col-md-12"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="mselect_reset" class="btn btn-info btn-sm pull-left">Сбросить</button>
                        <button type="button" id="mselect_change" class="btn btn-info btn-sm pull-right">Изменить</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="textarea_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Редактирование</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <textarea id="textarea_textarea" class="col-md-12"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="textarea_reset" class="btn btn-info btn-sm pull-left">Сбросить</button>
                        <button type="button" id="textarea_change" class="btn btn-info btn-sm pull-right">Изменить</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="select_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Редактирование</h4>
                    </div>
                    <div class="modal-body">
<!--
                        <div class="row">
                            <select class="select_select" id="select_select"></select>
                        </div>
-->
						<div class="row">
                            <textarea id="select_textarea" class="col-md-12"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="mselect_reset" class="btn btn-info btn-sm pull-left">Сбросить</button>
                        <button type="button" id="mselect_change" class="btn btn-info btn-sm pull-right">Изменить</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">


            var data = <?=json_encode($grid_data, true)?>,
                column_models = <?=$column_models?>,
                column_names = <?=$column_names?>;
            jQuery(function($) {
                


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
                {title:"Редактировать",action:function(event,ui){jQuery(grid_selector).jqGrid('editGridRow',getClickedRowId(event,ui),{width:450});}},

                {title:"История изменений",action:function(event,ui)
					{
                        var rowId = getClickedRowId(event,ui),
                            // get row data
                            rowData = $(Structure.options.grid_selector).jqGrid("getGridParam", "data")[rowId - 1],
                            // get cell name by grid selector
                            cellName = ui.target[0].getAttribute('aria-describedby').replace(Structure.options.grid_selector.replace('#', '')+'_', '');

						$.ajax({
							url:'ajax/get_history_cell',
							type:'POST',
							data:{
                              rowId:rowId,
                              collIndex:getClickedColNum(event,ui),
                              cellName:cellName,
                              authority_id:rowData['id_authority'],
                            },
							success: function(data)
							{
								$('#changes').html(data);
							}
						});
						$("#changes").modal();
					}
				}
                    ]
            });
            
            
            function getClickedRowId(event,ui) //get id of the clicked row
            {
                var rowid;
                if (ui.target[0].parentNode.nodeName=='TR')
                {
                    rowid=ui.target[0].parentNode.id;
                }
                else if (ui.target[0].parentNode.parentNode.nodeName=='TR')
                {
                    rowid=ui.target[0].parentNode.parentNode.id;
                }
                else {return false;}
                return rowid;
            }
            
            function getClickedColNum(event,ui) //get clicked td index in tr
            {
                var cellid;
                var currentRow;
                currentRow=$('#'+getClickedRowId(event,ui)+' td');
                for (var i=0; i<=currentRow.length; i++)
                {
                    if (ui.target[0]==currentRow[i] | ui.target[0].parentNode==currentRow[i]){cellid=i;}
                }
                return cellid;
            }
        </script>

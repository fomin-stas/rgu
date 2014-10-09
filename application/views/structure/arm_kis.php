        <div class="main-container">
            <div class="tabbable col-md-12" id="gridTabs">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li>
                        <a href="#new_authorities" data-toggle="tab">Новые согласования (<?=count($grid_data['new_authorities'])?>)</a>
                    </li>
                    <li>
                        <a href="#in_working" data-toggle="tab">Полномочия в работе (<?=count($grid_data['in_working'])?>)</a>
                    </li>
                    <li>
                        <a href="#in_process" data-toggle="tab">Исполняемые (<?=count($grid_data['in_process'])?>)</a>
                    </li>
                    <li  class="active">
                        <a href="#all" data-toggle="tab">Полный перечень (<?=count($grid_data['all'])?>)</a>
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
                        <div class="row">
                            <select class="mselect_select" id="mselect_select"></select>
                            <button type="button" id="mselect_add" class="btn btn-info btn-sm">Добавить</button>
                        </div>
                        <hr>
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
                        <div class="row">
                            <select class="select_select" id="select_select"></select>
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
            /*var grid_data = 
            [ 
                    {id_poln:"4564567",name_iogv:"Обеспечивать в пределах компетенции Комитета выполнение федеральных программ, в реализации которых участвует Санкт-Петербург, а также программ развития Санкт-Петербурга.",status_poln:"<p style='color:green'>Полномочию присвоен статус</p>",name_usl:"<div class='cell_div_func'>Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург</div><hr><div class='cell_div_usl'>Выполнение федеральных программ развития Санкт-Петербурга</div>",id_usl:"<div class='cell_div_func'>4564570</div><hr><div class='cell_div_usl'>4564571</div>", status_usl:"<div class='cell_div_func' style='color:#6699ff'>Ожидает согласования КИС</div><hr><div class='cell_div_usl' style='color:#6699ff'>Разрабатывается регламент</div>",srok_otveta:"<div class='cell_div_func'>29.04.2014</div><hr><div class='cell_div_usl'>-</div>",type:"<div class='cell_div_func'>функция</div><hr><div class='cell_div_usl'>услуга</div>",status_isp:"<div class='cell_div_func'>Общая</div><hr><div class='cell_div_usl'>Общая</td></div>",name_iogvspb:"<div class='cell_div_func'>Архивный комитет</div><hr><div class='cell_div_usl'>Архивный комитет</div>"},
                    {id_poln:"4564566",name_iogv:"Разрабатывать и утверждать схему и программу развития электроэнергетики Санкт-Петербурга",status_poln:"<p style='color:#6699ff'>На согласовании</p>",name_usl:"Разработка и утверждение схемы и программы развития электроэнергетики Санкт-Петербурга",id_usl:"4564556", status_usl:"<p style='color:#6699ff'>Ожидает согласования КИС</p>",srok_otveta:"30.04.2014",type:"функция",status_isp:"Общая",name_iogvspb:"Архивный комитет"},
                    {id_poln:"4564565",name_iogv:"Обеспечивает реализацию программы развития конкуренции в Российской Федерации в соответствии с компетенцией Комитета и разрабатывает региональную программу развития конкуренции в Санкт-Петербурге",status_poln:"<p style='color:#6699ff'>На согласовании</p>",name_usl:"Обеспечивает реализацию программы развития конкуренции в Российской Федерации в соответствии с компетенцией Комитета и разрабатывает региональную программу развития конкуренции в Санкт-Петербурге",id_usl:"4564562", status_usl:"<p style='color:#6699ff'>Ожидает согласования КИС</p>",srok_otveta:"30.04.2014",type:"функция",status_isp:"Общая",name_iogvspb:"Архивный комитет"},
                    {id_poln:"4564564",name_iogv:"Взаимодействует в установленном порядке по вопросам своей компетенции с органами государственной власти, органами местного самоуправления, иными государственными и негосударственными организациями, а также должностными лицами.",status_poln:"<p style='color:#6699ff'>На согласовании</p>",name_usl:"Осуществлять взаимодействие  по вопросам, находящимся в  компетенции исполнительного  органа государственной власти Санкт-Петербурга, с органами государственной власти и органами местного самоуправления, организациями, общественными",id_usl:"4564561", status_usl:"<p style='color:#6699ff'>Ожидает согласования КИС</p>",srok_otveta:"30.04.2014",type:"функция",status_isp:"Общая",name_iogvspb:"Архивный комитет"},
                    {id_poln:"1",name_iogv:"наименование полномочия1",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"1", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"2",name_iogv:"наименование полномочия2",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"2", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"3",name_iogv:"наименование полномочия3",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"3", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"4",name_iogv:"наименование полномочия4",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"4", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"5",name_iogv:"наименование полномочия5",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"5", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"6",name_iogv:"наименование полномочия6",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"6", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"7",name_iogv:"наименование полномочия7",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"7", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"8",name_iogv:"наименование полномочия8",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"8", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"9",name_iogv:"наименование полномочия9",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"9", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"10",name_iogv:"наименование полномочия10",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"10", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"11",name_iogv:"наименование полномочия11",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"11", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"12",name_iogv:"наименование полномочия12",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"12", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"13",name_iogv:"наименование полномочия13",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"13", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"14",name_iogv:"наименование полномочия14",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"14", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"15",name_iogv:"наименование полномочия15",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"15", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"16",name_iogv:"наименование полномочия16",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"16", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"17",name_iogv:"наименование полномочия17",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"17", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"18",name_iogv:"наименование полномочия18",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"18", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"},
                    {id_poln:"19",name_iogv:"наименование полномочия19",status_poln:"статус полномочия",name_usl:"наименование",id_usl:"19", status_usl:"статус",srok_otveta:"30.04.2014",type:"тип",status_isp:"статус",name_iogvspb:"Наименование ИОГВ СПб"}
            ];*/

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
                            console.log(rowData, cellName, getClickedColNum(event,ui));

						$.ajax({
							url:'ajax/get_history_cell',
							type:'POST',
							data:'rowId='+rowId+'&collIndex='+getClickedColNum(event,ui)+'&cellName='+cellName,
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

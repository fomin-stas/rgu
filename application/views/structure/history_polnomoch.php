
        <div class="main-container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 center">
                        <h4>Согласовывать результаты технических обследований централизованных систем горячего водоснабжения, холодного водоснабжения и водоотведения</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-striped">
                            <tr>
                                <td>ID</td>
                                <td>4676529876</td>
                            </tr>
                            <tr>
                                <td>Реквизиты постановления</td>
                                <td>Постановление Правительства Санкт-Петербурга от 29.11.2013 № 940 "О мерах по реализации Закона Санкт-Петербурга "О разгранисении полномочий органов государственной власти Санкт-Петербурга в сфере водоснабжения и водоотведения"</td>
                            </tr>
                            <tr>
                                <td>Ответственный орган</td>
                                <td>Комитет по энергетике и инженерному обеспечению</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="ui-jqgrid ui-corner-all">
                            <table id="grid-table"></table>
                        </div>
                        <div id="grid-pager"></div>
                    </div>
                </div>
            </div>

        </div>
        
        <script type="text/javascript">
            var grid_data = 
            [ 
                    {date_izm:"21.04.2014",status_razgr:"КИС согласовал разграничение",comments:"Отсутствуют",list:"Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург <hr> Выполнение федеральных программ развития Санкт-Петербурга"},
                    {date_izm:"20.04.2014",status_razgr:"Новое разграничение",comments:"Читать комментарии",list:"Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург <hr> Выполнение федеральных программ развития Санкт-Петербурга"},
                    {date_izm:"18.04.2014",status_razgr:"КИС не согласовал разграничение",comments:"Читать комментарии",list:"Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург <hr> Выполнение федеральных программ развития Санкт-Петербурга <hr> Выполнение федеральных программ развития Санкт-Петербурга"},
                    {date_izm:"16.04.2014",status_razgr:"Новое полномочие",comments:"Отсутствуют",list:"Выполнение федеральных программ, в реализации которых участвует Санкт-Петербург <hr> Выполнение федеральных программ развития Санкт-Петербурга <hr> Выполнение федеральных программ развития Санкт-Петербурга"}
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
                            height: "auto",
                            colNames:['Дата изменения статуса полномочия','Статус разграничения полномочия','Комментарии', 'Перечень услуг/функций'],
                            colModel:[
                                    {name:'date_izm',index:'date_izm', sorttype:"date", editable: false, fixed:true},
                                    {name:'status_razgr',index:'status_razgr', editable:false, fixed:true},
                                    {name:'comments',index:'izm_sved', editable: false, fixed:true},
                                    {name:'list',index:'n_str_table', editable: false, fixed:true,width:'250'}
                            ], 

                            //viewrecords : true,
                            rowNum:-1,
                            rownumbers:true,
                            //rowList:[10,20,30],
                            pager : pager_selector,
                            pgbuttons:false,
                            pginput:false,
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

                            //editurl: "/",//nothing is saved
                            caption: "Таблица истории согласования полномочий"


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
    
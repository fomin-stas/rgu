var Structure = {
	options: {
		data:''
	},

	init: function(){
		console.log('Structure');
	},

    initKIS: function(){
        console.log('Structure KIS');
        var grid_data = data.all,
            grid_selector = "#grid-table-all",
            pager_selector = "#grid-pager-all",
            text_link; //link cellcontent, must changes dynamicaly 

        // Tabs init
        $('#gridTabs .nav-tabs a:last').tab('show');
        $('#gridTabs .nav-tabs a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
            var tab_hash = e.target.hash.replace('#', '');
            var grid_selector = "#grid-table-"+tab_hash;
            var pager_selector = "#grid-pager-"+tab_hash;
            var grid_data = eval('data.'+tab_hash);
			$(window).triggerHandler('resize.jqGrid');
            Structure.renderGrid(grid_selector, pager_selector, grid_data);
        });


        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
                $(grid_selector).jqGrid( 'setGridWidth', $(".page-container").width() );
                $(grid_selector).jqGrid('setGridHeight',window.innerHeight-310); // 310-empiric value
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

        },

    initIOGV: function(){
        console.log('Structure IOGV');
        var grid_data = data.all,
            grid_selector = "#grid-table-all",
            pager_selector = "#grid-pager-all",
            text_link; //link cellcontent, must changes dynamicaly 

        // Tabs init
        $('#gridTabs .nav-tabs a:last').tab('show');
        $('#gridTabs .nav-tabs a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
            var tab_hash = e.target.hash.replace('#', '');
            var grid_selector = "#grid-table-"+tab_hash;
            var pager_selector = "#grid-pager-"+tab_hash;
            var grid_data = eval('data.'+tab_hash);
            $(window).triggerHandler('resize.jqGrid');
            Structure.renderGrid(grid_selector, pager_selector, grid_data);
        });


        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
                $(grid_selector).jqGrid( 'setGridWidth', $(".page-container").width() );
                $(grid_selector).jqGrid('setGridHeight',window.innerHeight-310); // 310-empiric value
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
    },
    
    cellFormat: function (rowId, val, rawObject, cm)
    {
        if(rawObject.attr){
            var attr = rawObject.attr[cm.name],
                result;
            if(attr){
                if (attr.rowspan) {
                    result = ' rowspan=' + '"' + attr.rowspan + '"';
                } else if (attr.display) {
                    result = ' style="display:' + attr.display + '"';
                }
            }
            else{
                result = val;
            }
            console.log(rawObject.attr[cm.name]);    
        }
        return result;
    },

    render_colModel: function(grid_selector) {
        var cm=$(grid_selector).jqGrid('getGridParam','colModel'),
            rowsCount = $(grid_selector).getGridParam("records");
        
        function table_data_to_options(col)
        {
			var cells=$('tr[tabindex=-1] td[role="gridcell"]');
			var column=[];
			var obj={};
			var result=':показать все'
			for (k=0; k<cells.length; k++)
			{
				if (cells[k].cellIndex===col)
				{
					if ((cells[k].innerHTML!='&nbsp;')&&(cells[k].innerHTML!=undefined)&&(cells[k].innerHTML!=''))
					{
						column.push(cells[k].innerHTML);
					}
				}
			}
			var values=column.join().split(',');
			for (var i=0; i<values.length; i++)
			{
				var str=values[i];
				obj[str]=true;
			}
			var sorted=Object.keys(obj);
			for (var z=0; z<sorted.length; z++)
			{
				result+=(';'+sorted[z]+':'+sorted[z]);
			}
			return result;
		}                   
        
        for (var i=0; i<cm.length; i++)
        {   
            if (cm[i].stype=='multiselect')
            {
                cm[i].stype='select';
                cm[i].searchoptions.attr={multiple:'multiple'};
                cm[i].edittype='textarea';
                cm[i].editoptions={};
                console.log('render multiselect cm');
            }
            else if (cm[i].stype=='select')
            {
//				cm[i].searchoptions={value:":показать все;opt1:opt1;opt2:opt2"};
//				cm[i].searchoptions.attr={multiple:'multiple'};
				cm[i].searchoptions={value:table_data_to_options(i)};
				cm[i].searchoptions.attr={};
			}

            //colorized column
            for (r=0; r<rowsCount; r++) {
                $(grid_selector).jqGrid('setCell', r, cm[i].name, '',{'background-color':cm[i].color});
            }
        }
    },
            
	renderGrid: function(grid_selector, pager_selector, grid_data) {
		jQuery(grid_selector).jqGrid({
                subGrid : false,
                altRows : true,
                data: grid_data,
                datatype: "local",
                height: "auto",
                /*colNames:['ID полномочия','Наименование полномочия в соответствии с положением ИОГВ','Статус согласования разграничния полномочия', 'Наименование государственной функции (услуги)', 'ID услуги/функции','Статус согласования услуги/функци','Срок ответа','Тип','Статус исполнения','Наименование ИОГВ СПб'],
                colModel:[
                        {name:'id_poln',index:'id_poln', sorttype:"int", editable: false, fixed:true, width:'100',formatter:linkToStep,unformat:unLinkToStep},
                        {name:'name_iogv',index:'name_iogv', editable:true, edittype:"textarea", editoptions:{rows:"3"}, fixed:true, width:'250',formatter:linkToStep,unformat:unLinkToStep},
                        {name:'status_poln',index:'status_poln', stype:'select',edittype:"select",editoptions: {value:"Полномочию присвоен статус:Полномочию присвоен статус;На согласовании:На согласовании"},
                            searchoptions:{
                                sopt:['cn'],
                                value:":показать все;Полномочию присвоен статус:Полномочию присвоен статус;На согласовании:На согласовании"
                            }, 
                            editable: false, fixed:true, width:'250'},
                        {name:'name_usl',index:'name_usl', editable: false, edittype:"textarea", editoptions:{rows:"3"}, fixed:true, width:'250'},
                        {name:'id_usl',index:'id_usl', sorttype:"int", editable: false, fixed:true, width:'100'},
                        {name:'status_usl',index:'status_usl', sortable:true,editable:false,stype:'select', edittype:"select",editoptions:{value:"ожидает согласования КИС:ожидает согласования КИС;ожидает ответа ИОГВ:ожидает ответа ИОГВ;разрабатывается АР:разрабатывается АР"},searchoptions:{sopt:['cn'],value:":показать все;ожидает согласования КИС:ожидает согласования КИС;ожидает ответа ИОГВ:ожидает ответа ИОГВ;разрабатывается регламент:разрабатывается регламент"}, width:'200', fixed:true},
                        {name:'srok_otveta',index:'srok_otveta', sorttype:"date", editable:false, fixed:true, width:'120',searchoptions:{dataInit:function(elem){$(elem).datepicker;},sopt:['cn']}},
                        {name:'type',index:'type', editable: false, stype:'select', edittype:"select",editoptions: {value:"услуга:услуга;функция:функция"},searchoptions:{sopt:['cn'],value:":показать все;услуга:услуга;функция:функция"}, fixed:true, width:'100'},
                        {name:'status_isp',index:'status_isp', editable: false, edittype:"select",stype:'select',editoptions: {value:"общая:общая;исполняемая:исполняемая;исключаемая:исключаемая;исключено:исключено;дополнительно:дополнительно"},searchoptions:{sopt:['cn'],value:":показать все;общая:общая;исполняемая:исполняемая;исключаемая:исключаемая;исключено:исключено;дополнительно:дополнительно"}, fixed:true, width:'120'},
                        {name:'name_iogvspb',index:'name_iogvspb', editable: true,stype:'select', edittype:"select",editoptions: {value:"архивный комитет:архивный комитет;комитет по здравоохранению:комитет по здравоохранению;комитет по оразованию:комитет по образованию"},searchoptions:{sopt:['cn'],value:":показать все;архивный комитет:архивный комитет;комитет по здравоохранению:комитет по здравоохранению;комитет по оразованию:комитет по образованию"}, fixed:true}
                        //{name:'nomer_punkta_iogv',index:'nomer_punkta_iogv', editable: true, fixed:true},
                        //{name:'vnes_izm_npa',index:'vnes_izm_npa', editable: true, fixed:true},
                        //{name:'isp_is',index:'isp_is', editable: true, fixed:true}
                ], */
                colNames: column_names,
                colModel: column_models,
                //viewrecords : true,
                rowNum:-1,
                rownumbers:true,
                //rowList:[10,20,30],
                pager : pager_selector,
                pgbuttons:false,
                pginput:false,
                sortable: true,
                multiselect: true,
                multiboxonly: true,
                deepempty: true,
                ignoreCase: true,
				mtype: "POST",
                cellEdit: true,
                cellsubmit: "remote",
				cellurl: 'ajax/edit_property',	//'string' - the url where the cell is to be saved.
//				ajaxCellOptions:	object - This option allow to set global ajax settings for the cell editing when we save the data to the server. 
				beforeProcessing: function(data)
				{
					Structure.render_colModel(grid_selector);
				},
                loadComplete : function() {
					$(grid_selector).jqGrid( 'setGridWidth', $(".page-container").width() );
					$(grid_selector).jqGrid('setGridHeight',window.innerHeight-360);
					Structure.render_colModel(grid_selector);
					var table = this;
					setTimeout(function(){
							Structure.styleCheckbox(table);
							Structure.updateActionIcons(table);
							Structure.updatePagerIcons(table);
							Structure.enableTooltips(table);
					}, 0);
                },

                
                beforeSelectRow:function(rowid){return false;},
                ondblClickRow:function(rowid, iRow, iCol)
                {
                    jQuery(grid_selector).editCell(iRow,iCol,true);
                },

				beforeEditCell:function(rowid,cellname,value,iRow,iCol)
                {
                    var cm=$(grid_selector).jqGrid('getGridParam','colModel')[iCol];
                    if (cm.stype==='select')
                    {
                        if(cm.searchoptions.attr.multiple)
                        {
                            var soptions=cm.searchoptions.value.split(';');
                            for(i=0;i<soptions.length;i++)
                            {
                                soptions[i]=soptions[i].split(':');
                                $('#mselect_select').append('<option value="'+soptions[i][0]+'">'+soptions[i][1]+'</option>');
                            }
                            console.log(soptions);
                            
                            $('#multiselect_edit').modal('show');
                            $('#mselect_textarea')[0].value=value;
                            console.log('show');
                            $('#mselect_change').unbind('click').on('click',function(){
                                $('#'+iRow+'_'+cellname)[0].value=$('#mselect_textarea')[0].value;
                                jQuery(grid_selector).saveCell(iRow,iCol);
                                $('#multiselect_edit').modal('hide');
                                $('#mselect_textarea')[0].value='';
                                $('#mselect_select')[0].options='';
                            });
                            
                        }
                        else 
                        {
							var soptions=cm.searchoptions.value.split(';');
                            for(i=0;i<soptions.length;i++)
                            {
                                soptions[i]=soptions[i].split(':');
                                $('#select_select').append('<option value="'+soptions[i][0]+'">'+soptions[i][1]+'</option>');
                            }
                            console.log(soptions);
                            
                            $('#select_edit').modal('show');
                            $('#select_select')[0].value=value;
                            console.log('show');
                            $('#select_change').unbind('click').on('click',function(){
                                $('#'+iRow+'_'+cellname)[0].value=$('#select_select')[0].value;
                                jQuery(grid_selector).saveCell(iRow,iCol);
                                $('#select_edit').modal('hide');
                                $('#select_select')[0].options='';

							});
						}
 
					}
					else 
					{
						$('#textarea_edit').modal('show');
						$('#textarea_textarea')[0].value=value;
						console.log('show');
						$('#textarea_change').unbind('click').on('click',function(){
							$('#'+iRow+'_'+cellname)[0].value=$('#textarea_textarea')[0].value;
							jQuery(grid_selector).saveCell(iRow,iCol);
							$('#textarea_edit').modal('hide');
						});
					}     
                                
                    $('#mselect_select,#select_select').multiselect({
                        buttonClass:'btn btn-white btn-sm col-md-10',
                        buttonContainer:"<span class='dropdown'>",
                        checkboxName:"edit_chb[]",
                        nonSelectedText:"Не выбрано",
                        includeSelectAllOption:true,
                        selectAllText:"Все",
                        enableCaseInsensitiveFiltering:true,
                        filterBehavior:'both',
                        filterPlaceholder:"Поиск",
                        onChange:function(){}
                    });
				},    
                //editurl: "/",//nothing is saved
                caption: "Таблица полномочий АРМ КИС"

        });
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
                        view: false,
                        viewicon : 'ace-icon fa fa-search-plus grey'
                },
                {
                        width: 450,
                        recreateForm: true,
                        viewPagerButtons:false,
                        beforeShowForm : function(e) {
                                var form = $(e[0]);
                                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
                                Structure.style_edit_form(form);
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
                                .wrapInner('<div class="widget-header" />');
                                Structure.style_edit_form(form);
                        }
                },
                {
                        //delete record form
                        recreateForm: true,
                        beforeShowForm : function(e) {
                                var form = $(e[0]);
                                if(form.data('styled')) return false;

                                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
                                Structure.style_delete_form(form);

                                form.data('styled', true);
                        },
                        onClick : function(e) {
                                alert(1);
                        }
                },
                {
                        //search form
                        width:1200,
                        recreateForm: true,
                        afterShowSearch: function(e){
                                var form = $(e[0]);
                                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
                                Structure.style_search_form(form);
                        },
                        afterRedraw: function(){
                                Structure.style_search_filters($(this));
                        },
                        multipleSearch: true,
                        multipleGroup: true
                },
                    
                {
                        //view record form
                        width:700,
                        //viewPagerButtons:true,
                        recreateForm: true,
                        beforeShowForm: function(e){
                                var form = $(e[0]);
                                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header"/>');
                        }
                }
        );
    
        //add new
        jQuery(grid_selector).jqGrid('navGrid',pager_selector).jqGrid('navButtonAdd',pager_selector,
        {
            id:"#add_new",
            buttonicon:"ace-icon fa fa-plus-circle purple",
            caption:"",
            title:"Новое полномочие",
            onClickButton: function(){location="structure/step1";}

        });
    
        //set columns
        jQuery(grid_selector).jqGrid('navGrid',pager_selector).jqGrid('navButtonAdd',pager_selector,
        {
            id:"#select_cols",
            buttonicon:"ace-icon fa fa-cog",
            caption:"",
            title:"Настройки отображения таблицы",
            onClickButton:function() 
            {
				jQuery(grid_selector).setColumns(
				{
					recreateForm: true,
					modal:true,
					width:500,
					jqModal:true,
					colnameview:false,
					updateAfterCheck:true,
					top:107,
					left:29
				});
			return false;
				
                //jQuery(grid_selector).columnChooser
                //({
                    //title:"options",
                    //width:1000
                    
                //});
                
            }
        });


        //to Excel
        jQuery(grid_selector).jqGrid('navGrid',pager_selector).jqGrid('navButtonAdd',pager_selector,
        {
            id:"#to_excel_btn",
            buttonicon:"ace-icon fa fa-external-link red",
            caption:"",
            title:"Выгрузить в Excel"

        });

        //footer (pager) search
        $(pager_selector+"_right").empty();
        $(pager_selector+"_right").append("<i class='ace-icon fa fa-search nav-search-icon'></i><input type='text' id='my_pag_search'>"); //place search input in footer
        $("#my_pag_search").on('change keyup',function(event,ui)
        {
            var rows=$("tr[role='row']"); //get all rows.
            for (var i=1; i<=rows.length; i++) //start from second row - the first row whith meaning data
            {
                if (rows[i].textContent.toLowerCase().match(this.value.toLowerCase())===null) //if row does not contain input content
                {
                    rows[i].style.display="none"; //hide this row
                }
                else {rows[i].style.display="table-row";} // else show  this row.
            }
        });
        
        
        $("#timeline_search_input").on('change keyup',function (event,ui)
        {
            var timeline_items = $(".timeline-item");
            for (var i=0; i<timeline_items.length; i++)
            {
                if (timeline_items[i].textContent.toLowerCase().match(this.value.toLowerCase())===null)
                {
                    timeline_items[i].style.display="none";
                    timeline_items[i].parentNode.previousElementSibling.style.display="none";
                }
                else
                {
                    timeline_items[i].style.display="block";
                    timeline_items[i].parentNode.previousElementSibling.style.display="block";
                }
            }
        });

		function getColumnIndexByName(columnName) {
			var cm = $(grid_selector).jqGrid('getGridParam', 'colModel'), i, l = cm.length;
			for (i = 0; i < l; i += 1) {
				if (cm[i].name === columnName) {
					return i; // return the index
				}
			}
			return -1;
		};

		function search_with_tb_filters()
            {
                var filters=$(".ui-search-input>input,.ui-search-input>select");
                
                filters.map(function(){
                    $(this).on('change keyup',function(){
                        var value=this.value;
                        console.log("value: "+value);
                        var filter_index=getColumnIndexByName(this.name);
                        var column=$('tr[tabindex=-1] td[role="gridcell"]').map(function(){
                            if(this.cellIndex==filter_index){return this;}
                        }).get();
                        var controll=0;
                        
                        for(var i=0; i<column.length; i++)
                        {
							if (typeof value==='string')
							{
								if(column[i].innerHTML.toLowerCase().match(value.toLowerCase())===null)
								{
									column[i].searchCheck=1;
									column[i].parentNode.style.display='none';
									
								}
								else 
								{
									column[i].searchCheck=0;
									column[i].parentNode.style.display='table-row';
								
								
									var siblings=$(column[i]).siblings();
									console.log(siblings);
									for (var j=0; j<siblings.length; j++)
									{
										if (siblings[j].searchCheck===1)
										{
											controll+=siblings[j].searchCheck;
										}
									}
									controll+=column[i].searchCheck;
									if(controll==0)
									{
										column[i].parentNode.style.display='table-row';
									}
									else
									{
										column[i].parentNode.style.display='none';
									}
									console.log("controll: "+controll);

									console.log("searchCheck: "+column[i].searchCheck);
								}
							}
							else if (typeof value==='array')
							{
								column[i].searchCheck=1;
								column[i].parentNode.style.display='none';
								for (var n=0; n<value.length; n++)
								{
									if(column[i].innerHTML.toLowerCase().match(value[n].toLowerCase())!==null)
									{
										column[i].searchCheck=0;
										column[i].parentNode.style.display='table-row';
										
										var siblings=$(column[i]).siblings();
										console.log(siblings);
										for (var j=0; j<siblings.length; j++)
										{
											if (siblings[j].searchCheck===1)
											{
												controll+=siblings[j].searchCheck;
											}
										}
										controll+=column[i].searchCheck;
										if(controll==0)
										{
											column[i].parentNode.style.display='table-row';
										}
										else
										{
											column[i].parentNode.style.display='none';
										}
										console.log("controll: "+controll);

										console.log("searchCheck: "+column[i].searchCheck);
									}
								}
							}
                        }
                    });
                });
                
            }
		
		//enable search/filter toolbar
		var myDefaultSearch = "cn";
		 jQuery(grid_selector).jqGrid('filterToolbar',{defaultSearch: myDefaultSearch,
         searchOnEnter: false,
         enableClear: true,
         stringResult:true,
         clearSearch:false,
         beforeSearch:function()
         {
             //Change search-algoitm to multiselect. From stackoverflow
             var postData=$(grid_selector).jqGrid('getGridParam','postData');
             postData.filters=$.parseJSON(postData.filters);
             console.log(postData.filters);
             return true;
             
		}
                  
	});
	search_with_tb_filters();
		
		//multiselect
		$('.ui-search-input select').multiselect({
			buttonClass:'btn btn-white btn-sm',
			buttonContainer:"<span class='dropdown'>",
			buttonWidth:"100%",
//            checkboxName:"multiselect[]",
			nonSelectedText:"Не выбрано",
			includeSelectAllOption:true,
			selectAllText:"Все",
			onChange:function(){console.log('search');},
//            templates:{
//              ul:"<ul class='dropdown-menu'></ul>"
//          }
		});
		
		//multiselect cell editing
        $('#mselect_add').on('click',function(){
            if (!$('#mselect_textarea')[0].value)
            {
                $('#mselect_textarea')[0].value+=$('#mselect_select')[0].value;
            }
            else 
            {
                $('#mselect_textarea')[0].value+=(', '+$('#mselect_select')[0].value);
            }
        });

		$('#mselect_reset').on('click',function(){
            $('#mselect_textarea')[0].value='';
        });

		//make filters scroll-sensetive
		for (i=0; i<$('th span.dropdown').length;i++)
        {
        	var container=$('th span.dropdown')[i];
            var dropdown_ul=$('th span.dropdown ul.multiselect-container')[i];
            dropdown_ul.style.left=container.offsetLeft;
            dropdown_ul.style.top=container.offsetTop+15;
        }

		var delta;
		$('div.ui-jqgrid-bdiv')[0].addEventListener('scroll',function()
        {
        	var dropdown_ul;
            if(!delta){delta=0;}
            var true_delta=$('div.ui-jqgrid-bdiv')[0].scrollLeft-delta;
            delta=$('div.ui-jqgrid-bdiv')[0].scrollLeft;
            for (i=0; i<$('th span.dropdown').length;i++)
            {
            	dropdown_ul=$('th span.dropdown ul.multiselect-container')[i];
                dropdown_ul.style.left=parseInt(dropdown_ul.style.left)-true_delta;
            }
        });

        //Structure.add_hide_btn();
	},

	styleCheckbox: function (table) {

    },

    updateActionIcons: function (table) {

    },

    //replace icons with FontAwesome icons
    updatePagerIcons: function (table) {
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
        });
    },

    enableTooltips: function (table) {
        $('.navtable .ui-pg-button').tooltip({container:'body'});
        $(table).find('.ui-pg-div').tooltip({container:'body'});
    },
    style_delete_form: function(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>');
    },

    style_search_filters: function(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-g,roup').addClass('btn btn-xs btn-danger');
    },
    
    style_search_form: function(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable');
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
    },

    style_edit_form: function(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>');

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').hide();
        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');       
    },
    
    beforeDeleteCallback: function(e) {
        var form = $(e[0]);
        if(form.data('styled')) return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
        Structure.style_delete_form(form);

        form.data('styled', true);
    },

     beforeEditCallback: function(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
        Structure.style_edit_form(form);
    },

    restyle_setcol_icons: function() {
        var replacement = {
                'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140',
                'ui-icon-minus' : 'ace-icon fa fa-angle-double-right bigger-140'
        };

        $('.ui-multiselect > .selected > ul > li > a > .ui-icon').each(function(){
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
        });
    },

     add_hide_btn: function() //add hide icons
    {
        var row_length=document.getElementsByTagName('th').length;
        if (!document.getElementsByClassName('ui-search-input')) {row_length/=2;} //check, if there is toolbar-searh
        for (var i=1; i<=row_length; i++)
        {
            $("table[role='grid'] thead tr:first-child th[role='columnheader']:nth-child("+i+")").prepend("<i class='fa fa-times red2 hide_col_btn' id='close_btn_"+i+"' onclick='javascript:Structure.hide_column("+i+")'></i>");
        }
    },

    hide_column: function (button_num) //hide selected column
    {
        var close_icon=document.getElementById("close_btn_"+button_num); //take close icon by
        var all_icons=document.getElementsByClassName("hide_col_btn"); //take array of all icons of this type
        var requested_col_num;
        for (var i=0; i<=all_icons.length; i++) //search our icon in all icons
        {
            if (close_icon===all_icons[i]) //if we find it 
            {   
                requested_col_num=i+1; //the number of column to hide equals icon index in array 
            }
        }
        $("table[role='grid'] thead tr th[role='columnheader']:nth-child("+requested_col_num+")").hide(); //hide all th of this column
        $("table[role='grid'] tbody tr td[role='gridcell']:nth-child("+requested_col_num+")").hide(); //hide all td of this column
    }
}

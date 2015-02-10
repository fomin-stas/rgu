var Structure = {
    options: {
        data: '',
        grid_selector: '#grid-table-all',
        grid_selector_tab: 'all',
    },
    init: function () {
        console.log('Structure');
    },
    initKIS: function () {
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
            Structure.options.grid_selector_tab = tab_hash;
            var grid_selector = "#grid-table-" + tab_hash;
            Structure.options.grid_selector = grid_selector;
            var pager_selector = "#grid-pager-" + tab_hash;
            var grid_data = eval('data.' + tab_hash);
            $(window).triggerHandler('resize.jqGrid');
            Structure.renderGrid(grid_selector, pager_selector, grid_data);
        });

        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid('setGridWidth', $(".page-container").width());
            $(grid_selector).jqGrid('setGridHeight', window.innerHeight -
                    $('.tabbable.col-md-12>ul.nav.nav-tabs.tab-color-blue').height() -
                    $('.ui-state-default.ui-jqgrid-hdiv').height() -
                    $('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').height() -
                    $('.ui-pager-control').height() -
                    $('.navbar.navbar-default.navbar-fixed-top.h-navbar').height() -
                    50
                    );
        });
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid', function (ev, event_name, collapsed) {
            if (event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed') {
                $(grid_selector).jqGrid('setGridWidth', parent_column.width());
            }
        });

        Structure.renderGrid(grid_selector, pager_selector, grid_data);
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

        var tag_input = $('.ui-search-input').children();
        tag_input.tag({
            source: function (query, process) {
                var r1 = this.$element[0].previousSibling.name;
                $.ajax({
                    method: 'POST',
                    url: 'ajax/propertys_array/' + r1,
                    data: 'text=' + query
                }).done(function (result_items) {
                    results = $.parseJSON(result_items);
                    process(results);
                });
            }
        });
        tag_input.on('added', function (e, value) {
            var sgrid = $(grid_selector)[0];
            sgrid.triggerToolbar();

        });
        tag_input.on('removed', function (e, value) {
            var sgrid = $(grid_selector)[0];
            sgrid.triggerToolbar();

        });



    },
    initIOGV: function () {
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
            var grid_selector = "#grid-table-" + tab_hash;
            var pager_selector = "#grid-pager-" + tab_hash;
            var grid_data = eval('data.' + tab_hash);
            $(window).triggerHandler('resize.jqGrid');
            Structure.renderGrid(grid_selector, pager_selector, grid_data);
        });


        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid('setGridWidth', $(".page-container").width());
            $(grid_selector).jqGrid('setGridHeight', window.innerHeight -
                    $('.tabbable.col-md-12>ul.nav.nav-tabs.tab-color-blue').height() -
                    $('.ui-state-default.ui-jqgrid-hdiv').height() -
                    $('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').height() -
                    $('.ui-pager-control').height() -
                    $('.navbar.navbar-default.navbar-fixed-top.h-navbar').height() -
                    50
                    );
        });
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid', function (ev, event_name, collapsed) {
            if (event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed') {
                $(grid_selector).jqGrid('setGridWidth', parent_column.width());
            }
        });

        Structure.renderGrid(grid_selector, pager_selector, grid_data);
        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
        var tag_input = $('.ui-search-input').children();
        tag_input.tag({
            source: function (query, process) {
                var r1 = this.$element[0].previousSibling.name;
                $.ajax({
                    method: 'POST',
                    url: 'ajax/propertys_array/' + r1,
                    data: 'text=' + query
                }).done(function (result_items) {
                    results = $.parseJSON(result_items);
                    process(results);
                });
            }
        });
        tag_input.on('added', function (e, value) {
            var sgrid = $(grid_selector)[0];
            sgrid.triggerToolbar();

        });
        tag_input.on('removed', function (e, value) {
            var sgrid = $(grid_selector)[0];
            sgrid.triggerToolbar();

        });
    },
    cellFormat: function (rowId, val, rawObject, cm)
    {
        if (rawObject.attr) {
            var attr = rawObject.attr[cm.name],
                    result;
            if (attr) {
                if (attr.rowspan) {
                    result = ' rowspan=' + '"' + attr.rowspan + '"';
                } else if (attr.display) {
                    result = ' style="display:' + attr.display + '"';
                }
            }
            else {
                result = val;
            }
            console.log(rawObject.attr[cm.name]);
        }
        return result;
    },
    table_data_to_options: function (col)
    {
        var cells = $('tr[tabindex=-1] td[role="gridcell"]');
        var column = [];
        var obj = {};
        var result = ':показать все'
        for (k = 0; k < cells.length; k++)
        {
            if (cells[k].cellIndex === col)
            {
                if ((cells[k].innerHTML != '&nbsp;') && (cells[k].innerHTML != undefined) && (cells[k].innerHTML != ''))
                {
                    column.push(cells[k].innerHTML);
                }
            }
        }
        var values = column.join().split(',');
        for (var i = 0; i < values.length; i++)
        {
            var str = values[i];
            obj[str] = true;
        }
        var sorted = Object.keys(obj);
        for (var z = 0; z < sorted.length; z++)
        {
            result += (';' + sorted[z] + ':' + sorted[z]);
        }
        return result;
    },
    render_colModel: function (grid_selector) {
        var cm = $(grid_selector).jqGrid('getGridParam', 'colModel'),
                rowsCount = $(grid_selector).getGridParam("records");

        for (var i = 0; i < cm.length; i++)
        {
            if (cm[i].stype == 'multiselect')
            {
                //cm[i].stype = 'select';
                cm[i].stype = 'text';
                //cm[i].searchoptions = {value: Structure.table_data_to_options(i)};
                cm[i].searchoptions = {value: {}}; //here we set select options (values). It could be an abject {a:'a',b:'b'} or a string "a:a;b:b"
                cm[i].searchoptions.attr = {multiple: 'multiple'};
                cm[i].edittype = 'textarea';
                cm[i].editoptions = {};
                console.log('render multiselect cm');
            }
            else if (cm[i].stype == 'select')
            {
                cm[i].stype = 'text';
                //cm[i].searchoptions = {value: Structure.table_data_to_options(i)};
                cm[i].searchoptions = {value: {}}; //select options
                cm[i].searchoptions.attr = {multiple: 'multiple'};
                cm[i].edittype = 'textarea';
                cm[i].editoptions = {};
            }
//            else
//            {
//                cm[i].stype = 'select';
//                //cm[i].searchoptions = {value: Structure.table_data_to_options(i)};
//                cm[i].searchoptions = {value:{}}; //select options
//                cm[i].searchoptions.attr = {multiple: 'multiple'};
//                cm[i].edittype = 'textarea';
//                cm[i].editoptions = {};
//            }

            //colorized column
            for (r = 0; r < rowsCount; r++) {
                if (cm[i].color != '#ffffff') {
                    $(grid_selector).jqGrid('setCell', r, cm[i].name, '', {'background-color': cm[i].color});
                }
            }
        }
    },
    renderGrid: function (grid_selector, pager_selector, grid_data) {
        organization_name = $.cookie('organization_name');
        jQuery(grid_selector).jqGrid({
            subGrid: false,
            altRows: true,
            data: grid_data,
            //datatype: "local",
            height: 400,
            colNames: column_names,
            colModel: column_models,
            viewrecords: true,
            rowNum: 100,
            rownumbers: true,
            rowList: [100],
            pager: pager_selector,
            pgbuttons: true,
            pginput: true,
            sortable: false,
            multiselect: true,
            multiboxonly: true,
            deepempty: true,
            ignoreCase: true,
            autowidth: false,
            
            hoverrows:true, 
            loadui:"disable",
            
            //shrinkToFit:false,
            cellEdit: true,
            cellsubmit: "remote",
            cellurl: 'ajax/edit_property', //'string' - the url where the cell is to be saved.
            mtype: "GET",
            url: _options.page + '?type=' + Structure.options.grid_selector_tab,
            datatype: "json",
            jsonReader: {
                root: "Rows",
                page: "Page",
                total: "Total",
                records: "Records",
                //repeatitems: false,
                //userdata: "UserData",   
                //id: "Id"
            },
//				ajaxCellOptions:	object - This option allow to set global ajax settings for the cell editing when we save the data to the server. 
            beforeProcessing: function (data)
            {

                Structure.render_colModel(grid_selector);
            },
            beforeRequest: function () {
                $('#spiner').modal('show');
            },
            loadComplete: function () {
                $('#spiner').modal('hide');
                //bootbox.hideAll();
                $(grid_selector).jqGrid('setGridWidth', $(".page-container").width());
                $(grid_selector).jqGrid('setGridHeight', window.innerHeight -
                        $('.tabbable.col-md-12>ul.nav.nav-tabs.tab-color-blue').height() -
                        $('.ui-state-default.ui-jqgrid-hdiv').height() -
                        $('.ui-jqgrid-titlebar.ui-jqgrid-caption.ui-widget-header.ui-corner-top.ui-helper-clearfix').height() -
                        $('.ui-pager-control').height() -
                        $('.navbar.navbar-default.navbar-fixed-top.h-navbar').height() -
                        50
                        );
                Structure.render_colModel(grid_selector);
                var table = this;
                setTimeout(function () {
                    Structure.styleCheckbox(table);
                    Structure.updateActionIcons(table);
                    Structure.updatePagerIcons(table);
                    Structure.enableTooltips(table);
                }, 0);
            },
            beforeSelectRow: function (rowid) {
                return false;
            },
            ondblClickRow: function (rowid, iRow, iCol)
            {
                // get row data by dblclick on cell
                var rowData = $(this).jqGrid("getGridParam", "data")[rowid - 1];
                // get cell model
                var cm = $(this).jqGrid("getGridParam", "colModel");

                jQuery(grid_selector).editCell(iRow, iCol, true);
            },
            beforeEditCell: function (rowid, cellname, value, iRow, iCol)
            {
                $('#spiner').modal('show');
                var cm = $(grid_selector).jqGrid('getGridParam', 'colModel')[iCol];
                rowData = $(Structure.options.grid_selector).jqGrid("getGridParam", "data")[rowid - 1],
                $.ajax({
                    url: 'ajax/get_service_full_property',
                    type: 'POST',
                    data: {
                        rowId: rowid,
                        collIndex: iCol,
                        cellName: cellname,
                        value: value,
                        authority_id: rowData['id_authority']
                    },
                    success: function (data)
                    {
                        console.log(data);
                        $('#textarea_edit').html(data);
                        $('#textarea_edit').modal('show');
                        $('#spiner').modal('hide');
                    }
                });
                $('#textarea_edit').on('hide.bs.modal', function (event) {
                    jQuery(grid_selector).saveCell(iRow, iCol);
                });
                $('#textarea_edit').unbind('hide.bs.modal').on('hide.bs.modal', function (event) {
                    jQuery(grid_selector).restoreCell(iRow, iCol);
                });
                // $('#textarea_editor')[0].innerHTML = value;
                $('#textarea_change').unbind('click').on('click', function () {
                    $('#' + iRow + '_' + cellname)[0].value = $('#textarea_editor')[0].innerHTML;
                    jQuery(grid_selector).saveCell(iRow, iCol);
                    $('#textarea_edit').modal('hide');
                    $('#textarea_editor')[0].innerHTML = "";
                });
            },
            beforeSubmitCell: function (rowid, celname, value, iRow, iCol) {
                var result = {};
                // get row data by dblclick on cell
                var rowData = $(this).jqGrid("getGridParam", "data")[rowid - 1];
                var cm = $(this).jqGrid("getGridParam", "colModel");

                // prepare data for request
                result.id_authority = rowData.id_authority;
                result.id_service = rowData.id_service !== undefined ? rowData.id_service : 0;
                result.code = cm[iCol].name;
                return result;
            },
            //editurl: "/",//nothing is saved
            caption: organization_name

        });
        //navButtons
        jQuery(grid_selector).jqGrid('navGrid', pager_selector,
                {//navbar options
                    edit: false,
                    editicon: 'ace-icon fa fa-pencil blue',
                    add: false,
                    addicon: 'ace-icon fa fa-plus-circle purple',
                    del: false,
                    delicon: 'ace-icon fa fa-trash-o red',
                    search: true,
                    searchicon: 'ace-icon fa fa-search orange',
                    refresh: true,
                    refreshicon: 'ace-icon fa fa-refresh green',
                    view: false,
                    viewicon: 'ace-icon fa fa-search-plus grey'
                },
        {
            width: 450,
            recreateForm: true,
            viewPagerButtons: false,
            beforeShowForm: function (e) {
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
            beforeShowForm: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                        .wrapInner('<div class="widget-header" />');
                Structure.style_edit_form(form);
            }
        },
        {
            //delete record form
            recreateForm: true,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                if (form.data('styled'))
                    return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
                Structure.style_delete_form(form);

                form.data('styled', true);
            },
            onClick: function (e) {
                alert(1);
            }
        },
        {
            //search form
            width: 1000,
            recreateForm: true,
            afterShowSearch: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />');
                Structure.style_search_form(form);
            },
            afterRedraw: function () {
                Structure.style_search_filters($(this));
            },
            multipleSearch: true,
            multipleGroup: true
        },
        {
            //view record form
            width: 700,
            //viewPagerButtons:true,
            recreateForm: true,
            beforeShowForm: function (e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header"/>');
            }
        }
        );

        //add new
        if (location.href.match('structure/arm_kis'))
        {
            jQuery(grid_selector).jqGrid('navGrid', pager_selector).jqGrid('navButtonAdd', pager_selector,
                    {
                        id: "#add_new",
                        buttonicon: "ace-icon fa fa-plus-circle purple",
                        caption: "",
                        title: "Новое полномочие",
                        onClickButton: function () {
                            location = "structure/step1";
                        }

                    });
        }

        //set columns
        jQuery(grid_selector).jqGrid('navGrid', pager_selector).jqGrid('navButtonAdd', pager_selector,
                {
                    id: "#select_cols",
                    buttonicon: "ace-icon fa fa-cog",
                    caption: "",
                    title: "Настройки отображения таблицы",
                    onClickButton: function ()
                    {
                        jQuery(grid_selector).setColumns(
                                {
                                    recreateForm: true,
                                    modal: true,
                                    width: 500,
                                    dataheight: 300,
                                    jqModal: true,
                                    colnameview: false,
                                    updateAfterCheck: true,
                                    top: 107,
                                    left: 29
                                });

                        $("#search_columns").on('keyup', function ()
                        {
                            var rows = $(".ColTable tr"); //get all colum-names rows.
                            for (var i = 2; i < rows.length; i++) //start from second row - the first row whith meaning data
                            {
                                if (rows[i].textContent.toLowerCase().match(this.value.toLowerCase()) === null) //if row does not contain input's content
                                {
                                    rows[i].style.display = "none"; //hide this row
                                }
                                else {  // else show  this row.
                                    rows[i].style.display = "table-row";
                                }
                            }
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
        jQuery(grid_selector).jqGrid('navGrid', pager_selector).jqGrid('navButtonAdd', pager_selector,
                {
                    id: "#to_excel_btn",
                    buttonicon: "ace-icon fa fa-external-link red",
                    caption: "",
                    title: "Выгрузить в Excel",
                    onClickButton: function (e) {
                        var cols = [];
                        var colModel = $(this).getGridParam('colModel');
                        var selRows = $(this).getGridParam('selrow');
                        console.log(selRows, colModel);
                        /*$.each(colModel, function(i) {
                         if (!this.hidden) {
                         cols.push(this.name);
                         }
                         });
                         console.log(cols);
                         var pdata = $(this).jqGrid('getGridParam', 'postData');
                         var params ={
                         gridParams: jQuery.param(pdata),
                         columns: JSON.stringify(cols),
                         }
                         App.send('ajax/export_excel', 'post', params);*/
                    },
                });

        //footer (pager) search
        $(pager_selector + "_right").empty();
        $(pager_selector + "_right").append("<i class='ace-icon fa fa-search nav-search-icon'></i><input type='text' id='my_pag_search'>"); //place search input in footer
        $("#my_pag_search").on('change keyup', function (event, ui)
        {
            var rows = $("tr[role='row']"); //get all rows.
            for (var i = 1; i <= rows.length; i++) //start from second row - the first row whith meaning data
            {
                if (rows[i].textContent.toLowerCase().match(this.value.toLowerCase()) === null) //if row does not contain input content
                {
                    rows[i].style.display = "none"; //hide this row
                }
                else {
                    rows[i].style.display = "table-row";
                } // else show  this row.
            }
        });


        $("#timeline_search_input").on('change keyup', function (event, ui)
        {
            var timeline_items = $(".timeline-item");
            for (var i = 0; i < timeline_items.length; i++)
            {
                if (timeline_items[i].textContent.toLowerCase().match(this.value.toLowerCase()) === null)
                {
                    timeline_items[i].style.display = "none";
                    timeline_items[i].parentNode.previousElementSibling.style.display = "none";
                }
                else
                {
                    timeline_items[i].style.display = "block";
                    timeline_items[i].parentNode.previousElementSibling.style.display = "block";
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
        }
        ;

        function search_with_tb_filters()
        {
            var filters = $(".ui-search-input>input,.ui-search-input>select");

            filters.map(function () {
                $(this).on('change keyup', function () {
                    var value = $(this).val();
                    console.log("value: " + value);
                    var filter_index = getColumnIndexByName(this.name);
                    var column = $('tr[tabindex=-1] td[role="gridcell"]').map(function () {
                        if (this.cellIndex == filter_index) {
                            return this;
                        }
                    }).get();
                    var controll = 0;

                    for (var i = 0; i < column.length; i++)
                    {
                        if (typeof value === 'string')
                        {
                            if (column[i].innerHTML.toLowerCase().match(value.toLowerCase()) === null)
                            {
                                column[i].searchCheck = 1;
                                column[i].parentNode.style.display = 'none';

                            }
                            else
                            {
                                column[i].searchCheck = 0;
                                column[i].parentNode.style.display = 'table-row';


                                var siblings = $(column[i]).siblings();
                                console.log(siblings);
                                for (var j = 0; j < siblings.length; j++)
                                {
                                    if (siblings[j].searchCheck === 1)
                                    {
                                        controll += siblings[j].searchCheck;
                                    }
                                }
                                controll += column[i].searchCheck;
                                if (controll == 0)
                                {
                                    column[i].parentNode.style.display = 'table-row';
                                }
                                else
                                {
                                    column[i].parentNode.style.display = 'none';
                                }
                                console.log("controll: " + controll);

                                console.log("searchCheck: " + column[i].searchCheck);
                            }
                        }
                        else if (typeof value === 'object')
                        {
                            if (value === null) {
                                value = ['']
                            }
                            column[i].searchCheck = 1;
                            column[i].parentNode.style.display = 'none';

                            for (var n = 0; n < value.length; n++)
                            {
                                if (column[i].innerHTML.toLowerCase().match(value[n].toLowerCase()) !== null)
                                {
                                    column[i].searchCheck = 0;
                                    column[i].parentNode.style.display = 'table-row';

                                    var siblings = $(column[i]).siblings();
                                    console.log(siblings);
                                    for (var j = 0; j < siblings.length; j++)
                                    {
                                        if (siblings[j].searchCheck === 1)
                                        {
                                            controll += siblings[j].searchCheck;
                                        }
                                    }
                                    controll += column[i].searchCheck;
                                    if (controll == 0)
                                    {
                                        column[i].parentNode.style.display = 'table-row';
                                    }
                                    else
                                    {
                                        column[i].parentNode.style.display = 'none';
                                    }
                                    console.log("controll: " + controll);

                                    console.log("searchCheck: " + column[i].searchCheck);
                                }
                            }

                        }
                    }
                });
            });

        }

        $.jgrid.no_legacy_api = true;
        $.jgrid.useJSON = true;
        //enable search/filter toolbar
        var myDefaultSearch = "cn";
        jQuery(grid_selector).jqGrid('filterToolbar', {defaultSearch: myDefaultSearch,
            searchOnEnter: true,
            enableClear: true,
            stringResult: true,
            clearSearch: true,
            beforeSearch: function ()
            {
                var postData = $(grid_selector).jqGrid('getGridParam', 'postData');
                postData.filters = $.parseJSON(postData.filters);
                console.log(postData.filters);
//                return true; //prevents triggering

                var filters = postData.filters;
                var rules, iCol, rule, cmi, cm, i, parts, separator, group, l, j, str;
                separator = ";";
                cm = $(grid_selector).jqGrid('getGridParam', 'colModel');

                if (filters && filters.rules !== undefined && filters.rules.length > 0) {
                    rules = filters.rules;
                    for (i = 0; i < rules.length; i++) {
                        rule = rules[i];
                        iCol = getColumnIndexByName.call(this, rule.field);
                        cmi = cm[iCol];
                        if (iCol >= 0 &&
                                ((cmi.searchoptions === undefined || cmi.searchoptions.sopt === undefined)
                                        && (rule.op === myDefaultSearch)) ||
                                (typeof (cmi.searchoptions) === "object" &&
                                        $.isArray(cmi.searchoptions.sopt) &&
                                        cmi.searchoptions.sopt[0] === rule.op)) {
                            // make modifications only for the 'contains' operation
                            parts = rule.data.split(separator);
                            if (parts.length > 1) {
                                if (filters.groups === undefined) {
                                    filters.groups = [];
                                }
                                group = {
                                    groupOp: 'OR',
                                    groups: [],
                                    rules: []
                                };
                                filters.groups.push(group);
                                console.log(filters.groups);
                                for (j = 0, l = parts.length; j < l; j++) {
                                    str = parts[j];
                                    if (str) {
                                        // skip empty '', which exist in case of two separaters of once
                                        group.rules.push({
                                            data: parts[j],
                                            op: rule.op,
                                            field: rule.field
                                        });
                                    }
                                }
                                rules.splice(i, 1);
                                i--; // to skip i++
                            }
                        }
                    }
                    this.p.postData.filters = JSON.stringify(filters);

                }
            }

        });
        //search_with_tb_filters();

        //multiselect
        $('.ui-search-input select').multiselect({
            buttonClass: 'btn btn-white btn-sm',
            buttonContainer: "<span class='dropdown'>",
            buttonWidth: "100%",
//            checkboxName:"multiselect[]",
            nonSelectedText: "Не выбрано",
            includeSelectAllOption: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: "Поиск",
            numberDisplayed: 1,
            maxHeight: 300,
            selectAllText: "Все",
            onChange: function () {
                console.log('search');
            },
            templates: {
                ul: "<ul class='dropdown-menu'></ul>"
            }
        });

        //multiselect cell editing
        $('#mselect_add').on('click', function () {
            if (!$('#mselect_textarea')[0].value)
            {
                $('#mselect_textarea')[0].value += $('#mselect_select')[0].value;
            }
            else
            {
                $('#mselect_textarea')[0].value += (', ' + $('#mselect_select')[0].value);
            }
        });

        $('#mselect_reset').on('click', function () {
            $('#mselect_textarea')[0].value = '';
        });

        //make filters scroll-sensetive
        for (i = 0; i < $('th span.dropdown').length; i++)
        {
            var container = $('th span.dropdown')[i];
            var dropdown_ul = $('th span.dropdown ul.multiselect-container')[i];
            dropdown_ul.style.left = container.offsetLeft;
            dropdown_ul.style.top = container.offsetTop + 15;
        }

        var delta;
        $('div.ui-jqgrid-bdiv')[0].addEventListener('scroll', function ()
        {
            var dropdown_ul;
            if (!delta) {
                delta = 0;
            }
            var true_delta = $('div.ui-jqgrid-bdiv')[0].scrollLeft - delta;
            delta = $('div.ui-jqgrid-bdiv')[0].scrollLeft;
            for (i = 0; i < $('th span.dropdown').length; i++)
            {
                dropdown_ul = $('th span.dropdown ul.multiselect-container')[i];
                dropdown_ul.style.left = parseInt(dropdown_ul.style.left) - true_delta;
            }
        });

        //run wysiwyg editor
        $('#multiselect_editor, #select_editor, #textarea_editor').ace_wysiwyg({
            toolbar: {
//				fontSize:{
//					name: 'fontSize',
//					title: 'font size',
//					values:{1 : 'Size#1' , 2 : 'Size#2' , 3 : 'Size#3' , 4 : 'Size#4' , 5 : 'Size#5'}
//				},
//				bold:{
//					name: 'bold',
//					title: 'bold',
//					icon: 'ace-icon fa fa-bold'
//				},
//				italic:{
//					name: 'italic',
//					title: 'italic',
//					icon: 'ace-icon fa fa-italic'
//				},
//				createLink:{
//					name: 'createLink',
//					title: 'link',
//					placeholder: 'ссылка',
//					button_class: 'btn-purple',
//					button_text: 'ссылка'
//				}
            }
        });

        //Structure.add_hide_btn();

        //show/hide filters
        var counter = 0;
        if ($('tr[class="ui-search-toolbar"][role="rowheader"] th div'))
        {
            $('tr[class="ui-search-toolbar"][role="rowheader"] th div').first()[0].innerHTML = '<span id="hide_search" class="ui-icon ace-icon fa fa-minus"></span>';
        }
        else
        {
            $('tr[class=""][role="rowheader"] th div').first().innerHTML = '<span id="hide_search" class="ui-icon ace-icon fa fa-minus"></span>';
        }
        $('#hide_search').on('click', function () {
            counter = !counter;
            if (counter)
            {
                $('.ui-search-table').hide();
                $(this).removeClass('fa-minus');
                $(this).addClass('fa-plus');
            }
            else
            {
                $('.ui-search-table').show();
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');
            }
        });

    },
    styleCheckbox: function (table) {

    },
    updateActionIcons: function (table) {

    },
    //replace icons with FontAwesome icons
    updatePagerIcons: function (table) {
        var replacement =
                {
                    'ui-icon-seek-first': 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev': 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next': 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end': 'ace-icon fa fa-angle-double-right bigger-140'
                };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if ($class in replacement)
                icon.attr('class', 'ui-icon ' + replacement[$class]);
        });
    },
    enableTooltips: function (table) {
        $('.navtable .ui-pg-button').tooltip({container: 'body'});
        $(table).find('.ui-pg-div').tooltip({container: 'body'});
    },
    style_delete_form: function (form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>');
    },
    style_search_filters: function (form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-g,roup').addClass('btn btn-xs btn-danger');
    },
    style_search_form: function (form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable');
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
    },
    style_edit_form: function (form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>');

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').hide();
        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
    },
    beforeDeleteCallback: function (e) {
        var form = $(e[0]);
        if (form.data('styled'))
            return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
        Structure.style_delete_form(form);

        form.data('styled', true);
    },
    beforeEditCallback: function (e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />');
        Structure.style_edit_form(form);
    },
    restyle_setcol_icons: function () {
        var replacement = {
            'ui-icon-seek-first': 'ace-icon fa fa-angle-double-left bigger-140',
            'ui-icon-seek-prev': 'ace-icon fa fa-angle-left bigger-140',
            'ui-icon-seek-next': 'ace-icon fa fa-angle-right bigger-140',
            'ui-icon-seek-end': 'ace-icon fa fa-angle-double-right bigger-140',
            'ui-icon-minus': 'ace-icon fa fa-angle-double-right bigger-140'
        };

        $('.ui-multiselect > .selected > ul > li > a > .ui-icon').each(function () {
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if ($class in replacement)
                icon.attr('class', 'ui-icon ' + replacement[$class]);
        });
    },
    add_hide_btn: function () //add hide icons
    {
        var row_length = document.getElementsByTagName('th').length;
        if (!document.getElementsByClassName('ui-search-input')) {
            row_length /= 2;
        } //check, if there is toolbar-searh
        for (var i = 1; i <= row_length; i++)
        {
            $("table[role='grid'] thead tr:first-child th[role='columnheader']:nth-child(" + i + ")").prepend("<i class='fa fa-times red2 hide_col_btn' id='close_btn_" + i + "' onclick='javascript:Structure.hide_column(" + i + ")'></i>");
        }
    },
    hide_column: function (button_num) //hide selected column
    {
        var close_icon = document.getElementById("close_btn_" + button_num); //take close icon by
        var all_icons = document.getElementsByClassName("hide_col_btn"); //take array of all icons of this type
        var requested_col_num;
        for (var i = 0; i <= all_icons.length; i++) //search our icon in all icons
        {
            if (close_icon === all_icons[i]) //if we find it 
            {
                requested_col_num = i + 1; //the number of column to hide equals icon index in array 
            }
        }
        $("table[role='grid'] thead tr th[role='columnheader']:nth-child(" + requested_col_num + ")").hide(); //hide all th of this column
        $("table[role='grid'] tbody tr td[role='gridcell']:nth-child(" + requested_col_num + ")").hide(); //hide all td of this column
    },
    initNotifications: function () {
        //select all
        $('#selectAll').on('click', function () {
            if ($(this).is(':checked')) {
                $('.delete_trigger').prop('checked', true);
            }
            else {
                $('.delete_trigger').prop('checked', false);
            }
        });
    },
};

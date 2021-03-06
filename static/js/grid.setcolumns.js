;(function($){
/**
 * jqGrid extension for manipulating columns properties
 * Piotr Roznicki roznicki@o2.pl
 * http://www.roznicki.prv.pl
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
**/
$.jgrid.extend({
	setColumns : function(p) {
		p = $.extend({
			top : 0,
			left: 0,
			width: 200,
			height: '500px',
			dataheight: 'auto',
			modal: false,
			drag: true,
			beforeShowForm: null,
			afterShowForm: null,
			afterSubmitForm: null,
			closeOnEscape : true,
			ShrinkToFit : false,
			jqModal : false,
			saveicon: [true,"left","ui-icon-disk"],
			closeicon: [true,"left","ui-icon-close"],
			onClose : null,
			colnameview : true,
			closeAfterSubmit : true,
			updateAfterCheck : false,
			recreateForm : false
		}, $.jgrid.col, p ||{});
		return this.each(function(){
			var $t = this;
			if (!$t.grid ) { return; }
			var onBeforeShow = typeof p.beforeShowForm === 'function' ? true: false;
			var onAfterShow = typeof p.afterShowForm === 'function' ? true: false;
			var onAfterSubmit = typeof p.afterSubmitForm === 'function' ? true: false;			
			var gID = $t.p.id,
			dtbl = "ColTbl_"+gID,
			IDs = {themodal:'colmod'+gID,modalhead:'colhd'+gID,modalcontent:'colcnt'+gID, scrollelm: dtbl};
			if(p.recreateForm===true && $("#"+IDs.themodal).html() != null) {
				$("#"+IDs.themodal).remove();
			}
			if ( $("#"+IDs.themodal).html() != null ) {
				if(onBeforeShow) { p.beforeShowForm($("#"+dtbl)); }
				$.jgrid.viewModal("#"+IDs.themodal,{gbox:"#gbox_"+gID,jqm:p.jqModal, jqM:false, modal:p.modal});
				if(onAfterShow) { p.afterShowForm($("#"+dtbl)); }
			} else {
				var dh = isNaN(p.dataheight) ? p.dataheight : p.dataheight+"px";
				var formdata = "<div class='formdata' style='width:100%;overflow:auto;position:relative;'>\
                                                    <table class='ColTable' cellspacing='1' cellpading='2' border='0'><tbody>\
                                                    <tr><td colsan='3'><p>Выберите столбцы для отображения в таблице</p></td></tr>\
                                                    <tr><td><div class='input-group'>\
                                                        <input type='text' class='form-control' id='search_columns' />\
                                                        <span class='input-group-btn'>\
                                                            <input type='button' class='btn btn-info btn-sm' value='Поиск' />\
                                                        </span>\
                                                    </div></td></tr>\
                                                    <!--<tr><td><br>\
                                                        <select>\
                                                        <option>Полный перечень</option>\
                                                        <option>Сведения о полномочиях</option>\
                                                        <option>Сведения об услугах и функциях</option>\
                                                        </select>\
                                                        <label for='sostav_sved'>Состав сведений</label>\
                                                    </td></tr>--></tbody></table>\
                                                </div>";
                                formdata += "<div id='"+dtbl+"' class='formdata' style='width:100%;overflow:auto;position:relative;height:"+dh+";'>";
                                formdata += "<table class='ColTable settings_list' cellspacing='1' cellpading='2' border='0'><tbody>";
				for(i=0;i<this.p.colNames.length;i++){
					if(!$t.p.colModel[i].hidedlg) { // added from T. Tomov
						formdata += "<tr id='"+(i)+"_sortable_row'><td style='white-space: pre;'><input type='checkbox' style='margin-right:5px;' id='col_" + this.p.colModel[i].name + "' class='cbox' value='T' " + 
						((localStorage[Structure.options.grid_selector+'col_'+this.p.colModel[i].name+'_checked']=='true')?"checked":"") + " />" + "<label for='col_" + this.p.colModel[i].name + "'>" + this.p.colNames[i] + ((p.colnameview) ? " (" + this.p.colModel[i].name + ")" : "" )+ "</label></td></tr>";
					}
				}
				formdata += "</tbody></table></div>";
                                formdata += "<div class='formdata' style='width:100%;overflow:auto;position:relative;'>";
                                //formdata += "<input type='checkbox' style='margin-right:5px;' id='save_parameters' /><label for='save_parameters'>Сохранить настройки</label>";
                                //formdata += "<input type='button' id='new_sved' style='margin-right:5px;' class='btn btn-info pull-right' value='Добавить сведение'></div>";
				var bS  = !p.updateAfterCheck ? "<a href='javascript:void(0)' id='dData' class='fm-button ui-state-default ui-corner-all'>"+p.bSubmit+"</a>" : "",
				bC  ="<a href='javascript:void(0)' id='eData' class='fm-button ui-state-default ui-corner-all'>"+p.bCancel+"</a>";
				formdata += "<table border='0' class='EditTable' id='"+dtbl+"_2'><tbody><tr style='display:block;height:3px;'><td></td></tr><tr><td class='DataTD ui-widget-content'></td></tr><tr><td class='ColButton EditButton'>"+bS+"&#160;"+bC+"</td></tr></tbody></table>";
				p.gbox = "#gbox_"+gID;
				$.jgrid.createModal(IDs,formdata,p,"#gview_"+$t.p.id,$("#gview_"+$t.p.id)[0]);
                                $.jgrid.createModal(IDs,"<input type='text'>",p,"#new_sved","#new_sved"[0]);
				if(p.saveicon[0]==true) {
					$("#dData","#"+dtbl+"_2").addClass(p.saveicon[1] == "right" ? 'fm-button-icon-right' : 'fm-button-icon-left')
					.append("<span class='ui-icon "+p.saveicon[2]+"'></span>");
				}
				if(p.closeicon[0]==true) {
					$("#eData","#"+dtbl+"_2").addClass(p.closeicon[1] == "right" ? 'fm-button-icon-right' : 'fm-button-icon-left')
					.append("<span class='ui-icon "+p.closeicon[2]+"'></span>");
				}
				if(!p.updateAfterCheck) {
					$("#dData","#"+dtbl+"_2").click(function(e){
						for(i=0;i<$t.p.colModel.length;i++){
							if(!$t.p.colModel[i].hidedlg) { // added from T. Tomov
								var nm = $t.p.colModel[i].name.replace(/\./g, "\\.");
								if($("#col_" + nm,"#"+dtbl).attr("checked")) {
									$($t).jqGrid("showCol",$t.p.colModel[i].name);
									$("#col_" + nm,"#"+dtbl).attr("defaultChecked",true); // Added from T. Tomov IE BUG
								} else {
									$($t).jqGrid("hideCol",$t.p.colModel[i].name);
									$("#col_" + nm,"#"+dtbl).attr("defaultChecked",""); // Added from T. Tomov IE BUG
								}
							}
						}
						if(p.ShrinkToFit===true) {
							$($t).jqGrid("setGridWidth",$t.grid.width-0.001,true);
						}
						if(p.closeAfterSubmit) $.jgrid.hideModal("#"+IDs.themodal,{gb:"#gbox_"+gID,jqm:p.jqModal, onClose: p.onClose});
						if (onAfterSubmit) { p.afterSubmitForm($("#"+dtbl)); }
						return false;
					});
				} else {
					$(":input","#"+dtbl).click(function(e){
						var cn = this.id.substr(4);
						if(cn){
							if(this.checked) {
								$($t).jqGrid("showCol",cn);
                                                                localStorage[Structure.options.grid_selector+this.id+'_checked'] = true; //save state to localStorage
							} else {
								$($t).jqGrid("hideCol",cn);
                                                                localStorage[Structure.options.grid_selector+this.id+'_checked'] = false; //save state to localStorage
							}
							if(p.ShrinkToFit===true) {
								$($t).jqGrid("setGridWidth",$t.grid.width-0.001,true);
							}
							try{
								$(window).triggerHandler('resize.jqGrid');
							}
							catch(e){
								console.log("No additional grid resizing event available");
							}
						}
						return this;
					});
				}
				$("#eData", "#"+dtbl+"_2").click(function(e){
					$.jgrid.hideModal("#"+IDs.themodal,{gb:"#gbox_"+gID,jqm:p.jqModal, onClose: p.onClose});
					return false;
				});
				$("#dData, #eData","#"+dtbl+"_2").hover(
				   function(){$(this).addClass('ui-state-hover');}, 
				   function(){$(this).removeClass('ui-state-hover');}
				);				
				if(onBeforeShow) { p.beforeShowForm($("#"+dtbl)); }
				$.jgrid.viewModal("#"+IDs.themodal,{gbox:"#gbox_"+gID,jqm:p.jqModal, jqM: true, modal:p.modal});
				if(onAfterShow) { p.afterShowForm($("#"+dtbl)); }
                                
                                //add reordering
                                var index_before_reorder;
                                $('.ColTable.settings_list tbody').sortable({
                                    axis:'y',
                                    containment:'parent',
                                    stop:function(event,ui)
                                    {
                                        console.log(index_before_reorder);
                                        console.log(ui.item[0].rowIndex);
                                        var array_of_rowIndexes_obj=$('.ui-sortable tr').map(function()
                                        {
                                          return parseInt(this.id);
                                        });
                                        var array_of_rowIndexes = Array.prototype.slice.call(array_of_rowIndexes_obj); //Magic
                                        localStorage['array_of_rowIndexes'+Structure.options.grid_selector] = '['+array_of_rowIndexes+']';
                                        $(Structure.options.grid_selector).remapColumns(array_of_rowIndexes,true,false);
                                    }
                                });
    
			}
		});
	}
});
})(jQuery);

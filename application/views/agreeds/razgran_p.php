<div class="main-container">
    <div class="container">
        <div id="my-wizard" data-target="#step-container" class="wizard">
            <ul class="wizard-steps">
                <li data-target="#step1" class="complete">
                    <span class="step" >1</span>
                    <span class="title">Новое полномочие</span>
                </li>
                <li data-target="#step2" class="active">
                    <span class="step">2</span>
                    <span class="title">Присвоение статуса полномочию</span>
                </li>
                <li data-target="#step3">
                    <span class="step">3</span>
                    <span class="title">Согласование присвоения статуса</span>
                </li>
                <li data-target="#step4">
                    <span class="step">4</span>
                    <span class="title">Полномочию присвоен статус</span>
                </li>
            </ul>
        </div>
        <hr>
        <div class="step-content" id="step-container">
            <div class="step-pane" id="step1">
                <!-- step 1-->
            </div>

            <div class="step-pane active" id="step2">

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td>ID полномочия:</td>
                                <td><?= $authority_id ?></td>
                            </tr>
                            <tr>
                                <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                <td><?= isset($authority_name) ? $authority_name : 'не установлено' ?></td>
                            </tr>
                            <tr>
                                <td>№ пункта в положении об ИОГВ:</td>
                                <td><?= isset($punkt_iogv) ? $punkt_iogv : 'не установлен' ?></td>
                            </tr>
                            <tr>
                                <td>Наименование ИОГВ СПб:</td>
                                <td><?= isset($name_iogv) ? $name_iogv : 'не установлен' ?></td>
                            </tr>
                            <tr>
                                <td>Срок ответа:</td>
                                <td><? if (isset($srok_otveta)) echo $srok_otveta;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-striped table-condensed">
                            <tr>
                                <td>Ответственный орган:</td>
                                <td><?= $name_iogv ?></td>
                            </tr>
                            <tr>
                                <td>Статус:</td>
                                <td><p style="color:red">Ожидает присвоения статуса полномочия</p></td>
                            </tr>
                            <tr>
                                <td>Комментарий:</td>
                                <td><a href="comments/view/<?= $id_authority ?>">Читать комментарии</a></td>
                            </tr>
                            <tr>
                                <td>Приложенные файлы</td>
                                <td>
                                    <?php if (isset($files)): ?>
                                        <?php foreach ($files as $file): ?>
                                            <a href="file_storage/authority/<?= $file['file_name'] ?>"><?= $file['name'] ?></a><br>
                                        <?php endforeach; ?>
                                    <?php else: ?> 
                                        Нет прикрепленных файлов
                                    <?php endif; ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button type="button" class="btn btn-info btn-sm pull-left add_sr_btn">Услуга</button>
                        <button type="button" class="btn btn-info btn-sm pull-left add_sn_btn">Функция</button>
                        <button type="button" class="btn btn-info btn-sm pull-left add_sk_btn">Функция контроля и надзора</button>
                    </div>
                </div>
                <form name="step2_com" method="post" action="agreeds/step2_submit" enctype="multipart/form-data">
                    <input value="<?= $id_authority ?>" name="id_authority" hidden>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <div class="widget-toolbar">
                                        <ul id='razgran_u_f_tabs' class='nav nav-tabs'></ul>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main padding-16">
                                        <div class="tab-content" id="tab_content"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <button type="button" class="btn btn-info btn-sm pull-left add_sr_btn">Добавить услугу</button>
                            <button type="button"class="btn btn-info btn-sm pull-left add_sn_btn">Добавить функцию</button>
                            <button type="button"class="btn btn-info btn-sm pull-left add_sk_btn">Добавить функцию контроля и надзора</button>
                            <button type="button" id="send_btn" class="btn btn-info btn-sm pull-right">Отправить на согласование</button>
                        </div>
                    </div>
                    <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="clear" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Отправить</button>
                                </div>
                                <div class="modal-body">
                                    <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                    <textarea class="input-xxlarge left" name="comment_st2"></textarea>
                                    <div class="space-6"></div>
                                    <table class="table">
                                        <tr>
                                            <td> 
                                                <div class="row">
                                                    <div id="file_div">
                                                        <span class="col-md-10">
                                                            <input type="file" multiple id="step_file" name="step_file" class="files">
                                                        </span>
                                                    </div>
                                                    <button type="button" id="add_file" class="btn btn-warning btn-xs col-md-1">
                                                        <i class="ace-icon glyphicon-plus  bigger-110 icon-only"></i>
                                                    </button>
                                                    <script>

                                                    </script>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Предыдущие комментарии:</td>
                                        </tr>
                                        <tr>
                                            <td> <?= $comments ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
            <div class="step-pane" id="step3">
                <!-- step 3 -->
            </div>
            <div class="step-pane" id="step4">
                <!-- step 4 -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alert_fieldrequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Некоторые поля остались незаполненными.</h4>
            </div>
            <div class="modal-body">
                Внесите необходимые данные и попробуйте еще раз.
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="restore_session_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Доступна сохраненная копия.</h4>
			</div>
			<div class="modal-body">
				Желаете загрузить автоматически сохраненную версию документа?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-sm pull-left" id="restore_session_btn">Восстановить</button>
				<button type="button" class="btn btn-default btn-sm pull-right" id="delete_saves_btn">Отмена</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $('#step_file').ace_file_input({
            no_file: "Присоединить файл",
            btn_choose: "Выбрать",
            btn_change: "Изменить",
            enable_reset: true
        });

        num_files = 1;
        $('#add_file').click(function () {
            var str = '<span class="col-md-10"><input type="file" multiple id="step_file' + num_files + '" name="step_file' + num_files + '" class="files"></span><script>    $("#step_file' + num_files + '").ace_file_input({no_file: "Присоединить файл",btn_choose: "Выбрать",btn_change: "Изменить",enable_reset: true});';
            $('#file_div').append(str);
            num_files++;
        });

        //add new functions and services
        var num = {sr: 1, sn: 1, sk: 1};
        if(supports_html5_storage()){restore_progress("<?= $authority_id ?>");};//try to load state from localstorage
        function add_new_tab(type)
        {
            function tab_text()
            {
                if (type == 'sr') {
                    return 'Услуга';
                }
                else if (type == 'sn') {
                    return 'Функция';
                }
                else {
                    return 'Функция контроля/надзора';
                }
            }
            //insert navigation-tab and content
            var tab = "<li id='navtab_" + type + num[type] + "'><a href='#" + 'pane_' + type + num[type] + "' data-toggle='tab'>" + tab_text() + " " + num[type] + "</a><span class='close_tab'>×</span></li>";
            $('#razgran_u_f_tabs').append(tab);
            $.ajax({
                url: App.options.baseURL + 'ajax/get_service/' + type + '/' + num[type],
                type: 'get',
                success: function (data) {
                    $('#tab_content').append(data);
                }
            });
            num[type]++;
        }
        $(document).on('click', ".add_sr_btn", function () {
            add_new_tab("sr");
        });
        $(document).on('click', ".add_sn_btn", function () {
            add_new_tab("sn");
        });
        $(document).on('click', ".add_sk_btn", function () {
            add_new_tab("sk");
        });
        $(document).on("click", ".close_tab", function () {
            var anchor = $(this).siblings('a');
            $(anchor.attr('href')).remove();
            $(this).parent().remove();
            $(".nav-tabs li").children('a').first().click();
        });
    });
    
	function supports_html5_storage() {
		try {
			return 'localStorage' in window && window['localStorage'] !== null;
		} catch (e) {
			return false;
		}
	}
   
	function save_progress(index)
	{
		localStorage[index] = document.getElementById('step2').innerHTML;
		localStorage[index+'_num_sr'] = num.sr;
		localStorage[index+'_num_sn'] = num.sn;
		localStorage[index+'_num_skn'] = num.skn;
		function tag_values_to_localstorage(tagname)
		{
			for (var i=0; i<document.getElementsByTagName(tagname).length; i++)
			{
				var elem = document.getElementsByTagName(tagname)[i];
				if(elem.id){localStorage[elem.id+index] = elem.value;}
			}
		}
		tag_values_to_localstorage("TEXTAREA");
		tag_values_to_localstorage("SELECT");
	}
	
	function restore_progress(index)
	{
		function add_values_from_localstorage(tagname)
		{
			for (var i=0; i<document.getElementsByTagName(tagname).length; i++)
			{
				var elem = document.getElementsByTagName(tagname)[i];
				if(elem.id){elem.value = localStorage[elem.id+index];}
			}
		}

		if (localStorage[index])
		{
			$('#restore_session_modal').modal('show');
			$('#restore_session_btn').on('click',function(){
				document.getElementById('step2').innerHTML = localStorage[index];
				num.sr = localStorage[index+'_num_sr'] || 1;
				num.sn = localStorage[index+'_num_sn'] || 1;
				num.skn = localStorage[index+'_num_skn'] || 1;
				add_values_from_localstorage("TEXTAREA");
				add_values_from_localstorage("SELECT");
				$('#restore_session_modal').modal('hide');
			});
			$('#delete_saves_btn').on('click',function(){
				$('#restore_session_modal').modal('hide');
			});
			$('#restore_session_modal').on('hide.bs.modal',function(){
				window.setInterval(function(){save_progress("<?= $authority_id ?>");},5000);
			});
		}
		else {window.setInterval(function(){save_progress("<?= $authority_id ?>");},5000);}
	}
</script>

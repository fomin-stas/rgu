
<div class="main-container">
    <div class="container">
        <div id="my-wizard" data-target="#step-container" class="wizard">
            <ul class="wizard-steps">
                <li data-target="#step1" class="complete">
                    <span class="step">1</span>
                    <span class="title">Новое полномочие</span>
                </li>
                <li data-target="#step2" class="complete">
                    <span class="step">2</span>
                    <span class="title">Присвоение статуса полномочию</span>
                </li>
                <li data-target="#step3" class="complete">
                    <span class="step">3</span>
                    <span class="title">Согласование присвоения статуса</span>
                </li>
                <li data-target="#step4" class="active">
                    <span class="step">4</span>
                    <span class="title">Полносмочию присвоен статус</span>
                </li>
            </ul>
        </div>
        <hr>
        <div class="step-content" id="step-container">
            <div class="step-pane" id="step1">
                <!-- step 1-->
            </div>

            <div class="step-pane" id="step2">
                <!-- step 2 -->
            </div>

            <div class="step-pane" id="step3">
                <!-- step 3 -->
            </div>

            <div class="step-pane active" id="step4">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3 class="center">
                            Редактирование полномочия
                           
                        </h3>
                         <?= $id_authority_status == 2 ? '<h4 class="red center">(доступно редактирование статуса полномочия)</h4>':''?>
                        <table class="table table-striped">
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
                            <tr>
                                <td>Статус</td>
                                <td><p style="color:yellowgreen">Ожедает корректировки</p></td>
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
                        <a href="agreeds/history_polnomoch/<?= $id_authority ?>"><button class="btn btn-info btn-sm">История согласований полномочия</button></a>
                        <button type="button" id="send_btn" class="btn btn-info btn-sm pull-right">Отправить на согласование</button>
                    </div>
                </div>
                <?= $id_authority_status == 2 ? '
                <div class="row space-12"></div>
                <div class="row ">
                    <div class="col-md-10 col-md-offset-1">
                        <button type="button" class="btn btn-info btn-sm pull-left add_sr_btn">Добавить услугу</button>
                        <button type="button"class="btn btn-info btn-sm pull-left add_sn_btn">Добавить функцию</button>
                        <button type="button"class="btn btn-info btn-sm pull-left add_sk_btn">Добавить функцию контроля и надзора</button>

                    </div>
                </div>'
                : '' ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="widget-box">
                            <div class="widget-header">
                                <div class="widget-toolbar">
                                    <ul id="razgran_u_f_tabs" class="nav nav-tabs">
                                        <?php $service_num = 0; ?>
                                        <?php foreach ($services as $id_service => $service): ?>
                                            <?php $service_num++; ?>
                                            <li <?php if ($service_num == 1) echo 'class="active"'; ?>><a href="#usl_<?= $service_num; ?>" data-toggle="tab"><?= $service['type'] . ' ' . $service_num; ?></a><?= $id_authority_status == 2 ? '<span id="' . $id_service . '" class="close_tab">×</span>' : '' ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget-body">
                                <form class="form-horizontal" action="agreeds/update_properties/<?= $id_authority ?>" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <input value="<?= $id_authority ?>" name="id_authority" hidden>
                                        <div class="widget-main padding-16">
                                            <div class="tab-content" id="tab_content">
                                                <?php $tab_num = 0; ?>
                                                <?php foreach ($services as $id_service => $service): ?>
                                                    <?php $tab_num++; ?>
                                                    <div class="tab-pane <?php if ($tab_num == 1) echo 'active'; ?>" id="usl_<?= $tab_num; ?>" hidden>
                                                        <?= isset($service['properties']['sr_0']) ? load_form_textaea($id_service, 'sr_0', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_1']) ? load_form_textaea($id_service, 'sr_1', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_2']) ? load_form_dropdown($id_service, 'sr_2', $spher, $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_3']) ? load_form_dropdown($id_service, 'sr_3', array('Не выбрано' => 'Не выбрано', 'Администрация района' => 'Администрация района', 'Внебюджетный фонд' => 'Внебюджетный фонд', 'Государственное учреждение' => 'Государственное учреждение', 'ГУЖА' => 'ГУЖА', 'Органы местного самоуправления' => 'Органы местного самоуправления', 'Федеральный орган исполнительной власти' => 'Федеральный орган исполнительной власти'), $service, true, false) : ''; ?>
                                                        <?= isset($service['properties']['sr_4']) ? load_form_textaea($id_service, 'sr_4', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_5']) ? load_form_textaea($id_service, 'sr_5', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_6']) ? load_form_dropdown($id_service, 'sr_6', array("в традиционном порядке" => "в традиционном порядке", "через МФЦ" => "через МФЦ", "в электронном виде" => "в электронном виде"), $service, true, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_7']) ? load_form_textaea($id_service, 'sr_7', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_8']) ? load_form_textaea($id_service, 'sr_8', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_9']) ? load_form_dropdown($id_service, 'sr_9', array("физические лица" => "физические лица", "юридические лица" => "юридические лица", "индивидуальные предприниматели" => "индивидуальные предприниматели"), $service, true, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_10']) ? load_form_textaea($id_service, 'sr_10', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_11']) ? load_form_textaea($id_service, 'sr_11', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_12']) ? load_form_textaea($id_service, 'sr_12', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_13']) ? load_form_textaea($id_service, 'sr_13', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_14']) ? load_form_textaea($id_service, 'sr_14', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_15']) ? load_form_textaea($id_service, 'sr_15', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_16']) ? load_form_textaea($id_service, 'sr_16', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_17']) ? load_form_dropdown($id_service, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "не установлено" => "не установлено"), $service, true, false) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_18']) ? load_form_textaea($id_service, 'sr_18', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_19']) ? load_form_textaea($id_service, 'sr_19', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_20']) ? load_form_dropdown($id_service, 'sr_20', array("Да" => "Да", "Нет" => "Нет"), $service, true, false) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_21']) ? load_form_textaea($id_service, 'sr_21', $service, true) : ''; ?>
                                                        <?= ''; //isset($service['properties']['sr_22']) ? load_form_textaea($id_service, 'sr_22', $service, true) : ''; ?>

                                                        <?= ''; //isset($service['properties']['sr_24']) ? load_form_file($id_service, 'sr_24', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_25']) ? load_form_dropdown($id_service, 'sr_25', array("Рождение ребенка" => "Рождение ребенка", "Смена фамилии" => "Смена фамилии", "Индивидуальное жилищное строительство" => "Индивидуальное жилищное строительство", "открытие своего дела" => "открытие своего дела", "Смена места жительства" => "Смена места жительства", "Утрата документов" => "Утрата документов", "Потеря или поиск работы" => "Потеря или поиск работы", "Утрата близкого человека" => "Утрата близкого человека", "Выход на пенсию" => "Выход на пенсию"), $service, true, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_26']) ? load_form_dropdown($id_service, 'sr_26', array("Государственная (муниципальная) услуга" => "Государственная (муниципальная) услуга", "услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания" => "услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания", "услуга, необходимая и обязательная для предоставления государственной (муниципальной) услуги" => "услуга, необходимая и обязательная для предоставления государственной (муниципальной) услуги"), $service, true, false) : ''; ?>

                                                        <?= isset($service['properties']['sr_28']) ? load_form_dropdown($id_service, 'sr_28', array("Да" => "Да", "Нет" => "Нет"), $service, true, false) : ''; ?>

                                                        <?= isset($service['properties']['sn_12']) ? load_form_textaea($id_service, 'sn_12', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sn_14']) ? load_form_dropdown($id_service, 'sn_14', array("ДА" => "ДА", "НЕТ" => "НЕТ"), $service, true) : ''; ?>


                                                        <?= isset($service['properties']['sk_12']) ? load_form_textaea($id_service, 'sk_12', $service, true) : ''; ?>


                                                        <?= isset($service['properties']['sr_23']) ? load_form_file($id_service, 'sr_23', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_27']) ? load_form_textaea($id_service, 'sr_27', $service, true) : ''; ?>
                                                        <?= isset($service['properties']['sr_29']) ? load_form_textaea($id_service, 'sr_29', $service, true) : ''; ?>

                                                        <!--<button class="btn btn-info btn-sm pull-left" id="save_as_chern_usl">Сохранить как черновик</button>-->


                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="modal fade" id="comments_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form name="step4_com" method="post">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                                                <button type="submit" class="btn btn-primary">Отправить</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="modal-title" id="myModalLabel">Комментарий</h4>
                                                                <textarea class="input-xxlarge center col-md-11" name="comment"></textarea>
                                                                <div class="row space-10"></div>
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button id="send_btn" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#comments_modal">Отправить на согласование</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<script type="text/javascript">
    num = 0;

    $(".files").ace_file_input({
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


    $('.com_bt').click(function () {
        //сделать ajax запрос за коментариями
        id_service_property = $(this).attr('id');
        comments = '';

        $.ajax({
            url: App.options.baseURL + 'ajax/get_property_comments/' + id_service_property + '/' + num,
            type: 'get',
            success: function (data) {
                num = num + 1;
                comments = data;
                jQuery.gritter.add({
                    title: 'Комментарии',
                    text: comments,
                    sticky: true,
                    time: '',
                    class_name: 'gritter-info gritter-light'
                });
            }
        });
    });

    $(document).on("click", ".close_tab", function () {
        anchor = $(this).siblings('a');
        id_service = $(this).attr('id');
        parent_to_remove = $(this).parent();
        bootbox.confirm({
            message: "<h4 align='center'>Вы уверены что хотите перенести услугу (функцию, ФКН) в архив?</h4>",
            buttons: {
                confirm: {
                    label: "Да, перенести",
                    className: "btn-primary btn-sm"
                },
                cancel: {
                    label: "Нет",
                    className: "btn-sm"
                }
            },
            callback: function (result) {
                if (result == 1) {
                    $.ajax({
                        url: App.options.baseURL + 'ajax/remove_service/' + id_service,
                        type: 'get',
                        success: function (data) {
                            if (data == 0) {
                                text = '<h4>Архивация выполненна</h4>';
                                type_greeter = 'gritter-info';
                                $(anchor.attr('href')).remove();
                                parent_to_remove.remove();
                                $(".nav-tabs li").children('a').first().click();
                            } else {
                                text = '<h4>Произошла ошибка при архивации!</h4>';
                                type_greeter = 'gritter-error';
                            }
                            jQuery.gritter.add({
                                title: "",
                                text: text,
                                sticky: false,
                                time: '',
                                class_name: 'gritter-center ' + type_greeter
                            });
                        }
                    });
                }
            }
        });
    });

    ////////////////////////////////////////////////////////////////////////////
    //add new functions and services
    var num = {sr: 1, sn: 1, sk: 1};
    
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
        var tab = "<li id='navtab_" + type + num[type] + "'><a href='#" + 'pane_' + type + num[type] + "' data-toggle='tab'>" + tab_text() + " " + num[type] + "</a><span class='close_new_tab'>×</span></li>";
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
    
    $(document).on("click", ".close_new_tab", function () {
            var anchor = $(this).siblings('a');
            $(anchor.attr('href')).remove();
            $(this).parent().remove();
            $(".nav-tabs li").children('a').first().click();
        });

</script>


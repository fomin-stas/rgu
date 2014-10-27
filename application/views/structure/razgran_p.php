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
                                <td><?= (isset($authority_id)) ? $authority_id : "<font font-color=red>Отсутствует</font>"; ?></td>
                            </tr>
                            <tr>
                                <td>Наименование полномочия в соответствии с Положением об ИОГВ:</td>
                                <td><?= (isset($authority_name)) ? $authority_name : "<font font-color=red>Отсутствует</font>"; ?></td>
                            </tr>
                            <tr>
                                <td>№ пункта в положении об ИОГВ:</td>
                                <td><?= (isset($punkt_iogv)) ? $punkt_iogv : "<font font-color=red>Отсутствует</font>"; ?></td>
                            </tr>
                            <tr>
                                <td>Наименование ИОГВ СПб:</td>
                                <td><?= $name_iogv ?></td>
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
                                            <a href="file_storage/authority/<?= $file['file_name'] ?>"><?= $file['name'] ?></a>
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
                        <button class="btn btn-info btn-sm pull-left add_sr_btn">Услуга</button>
                        <button class="btn btn-info btn-sm pull-left add_sn_btn">Функция</button>
                        <button class="btn btn-info btn-sm pull-left add_sk_btn">Функция контроля и надзора</button>
                    </div>
                </div>
                <form name="step2_com" method="post" action="structure/step2_submit" enctype="multipart/form-data">
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
                                        <div class="row">
                                            <span class="col-md-6">
                                                <input type="file" multiple id="step2_file" name="step2_file[]">
                                            </span>
                                            <div class="form-group pull-right">
                                                <label for="sogl_inst" class="control-label">Согласующие инстанции</label>
                                                <select id="sogl_inst" class="">
                                                    <option>Комитет по информации и связи</option>
                                                    <option>КРИОГВ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <button class="btn btn-info btn-sm pull-left add_sr_btn">Добавить услугу</button>
                            <button class="btn btn-info btn-sm pull-left add_sn_btn">Добавить функцию</button>
                            <button class="btn btn-info btn-sm pull-left add_sk_btn">Добавить функцию контроля и надзора</button>
                            <button id="send_btn" class="btn btn-info btn-sm pull-right">Отправить на согласование</button>
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
                                    <textarea class="input-xxlarge left" name="comment_st2" required></textarea>
                                    <div class="space-6"></div>

                                    <table class="table">
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#step2_file').ace_file_input({
            no_file: "Присоединить файл",
            btn_choose: "Выбрать",
            btn_change: "Изменить",
            enable_reset: true
        });
        $('#send_btn').on('click', function () {
//            var text_fields = $('#tab_content textarea');
//            for (var textarea = 0; textarea < text_fields.length; textarea++) {
//                console.log(text_fields[textarea].value);
//                if (!text_fields[textarea].value) {
//                    console.log(text_fields[textarea]);
////                text_fields[textarea].before("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>Заполните это поле</div>");
////                text_fields[textarea].css('border','1px solid red');
//                    $('#alert_fieldrequest').modal('show');
//                    return 'empty textarea';
//                }
//            }
            $('#comments_modal').modal('show');
        });

        //add new functions and services
        var num = {sr: 1, sn: 1, sk: 1};
        function add_new_tab(type)
        {
            /*var tab_pane = $('#' + type).clone().attr('id', 'pane_' + type + num[type]); //clone existing tab-pane template and change id
            tab_pane[0].firstElementChild.id = 'form_' + type + num[type]; //give it new id and name
            tab_pane[0].firstElementChild.name += num[type];*/
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
            var tab = "<li id='navtab_" + type + num[type] + "'><a href='#" + 'pane_'+ type + num[type] + "' data-toggle='tab'>" + tab_text() + " " + num[type] + "</a></li>";
            $('#razgran_u_f_tabs').append(tab);
            $.ajax({
                url: App.options.baseURL + 'ajax/get_service/' + type + '/' + num[type],
                type: 'get',
                success: function(data) {
                    $('#tab_content').append(data);
                }
            });
            num[type]++;
        }

        $(document).on('click', ".add_sr_btn", function() {
            add_new_tab("sr");
        });
        $(document).on('click', ".add_sn_btn", function() {
            add_new_tab("sn");
        });
        $(document).on('click', ".add_sk_btn", function() {
            add_new_tab("sk");
        });


        $(function() {
            // If using Bootstrap 2, be sure to include:
            // Tags.bootstrapVersion = "2";

        });
    });
</script>


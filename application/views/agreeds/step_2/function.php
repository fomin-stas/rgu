<div class="tab-pane active" id="pane_sn<?= $service_num ?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2($service_num, 'sn_0', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sn_1', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sn_3', array('Не выбрано'=>'Не выбрано', 'Администрация района'=>'Администрация района', 'Внебюджетный фонд'=>'Внебюджетный фонд', 'Государственное учреждение'=>'Государственное учреждение', 'ГУЖА'=>'ГУЖА', 'Органы местного самоуправления'=>'Органы местного самоуправления', 'Федеральный орган исполнительной власти'=>'Федеральный орган исполнительной власти'), $property, false, false) ?>
            <?= load_form_textaea_step2($service_num, 'sn_4', $property, false); ?>
            
            <?= load_form_textaea_step2($service_num, 'sn_12', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sn_14', array("ДА" => "ДА", "НЕТ" => "НЕТ"), $property, false) ?>
            
            <?= load_form_textaea_step2($service_num, 'sn_27', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sn_29', $property, false); ?>
        </div>
    </div>
</div>
<script>
$('.files').ace_file_input({
            no_file: "Присоединить файл",
            btn_choose: "Выбрать",
            btn_change: "Изменить",
            enable_reset: true
        });
</script>

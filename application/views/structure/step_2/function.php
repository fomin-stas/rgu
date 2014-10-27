<div class="tab-pane active" id="pane_sr<?= $service_num ?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2($service_num, 'sn_0', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sn_1', array("Администрация района" => "Администрация района", "ВФ" => "ВФ", "ГУ" => "ГУ", "ГУЖА" => "ГУЖА", "МУ" => "МУ", "ОМСУ" => "ОМСУ", "ПНО" => "ПНО", "ФОИВ" => "ФОИВ"), $property, true) ?>
            <?= load_form_textaea_step2($service_num, 'sn_2', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_3', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_4', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_5', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_6', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_7', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_8', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_9', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_10', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_11', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_12', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_13', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sn_1', array("ДА" => "ДА", "НЕТ" => "НЕТ"), $property, true) ?>
            <?= load_form_textaea_step2($service_num, 'sn_15', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_16', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_17', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sn_18', $property, true); ?>
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

<div class="tab-pane active" id="pane_sr<?= $service_num ?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2($service_num, 'sr_0', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_1', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_2', $spher, $property, true) ?>
            <?= load_form_dropdown_step2($service_num, 'sr_3', $organization_provide_service, $property, true, true) ?>
            <?= load_form_textaea_step2($service_num, 'sr_4', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_5', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_6', array("в традиционном порядке" => "в традиционном порядке", "через МФЦ" => "через МФЦ", "в электронном виде" => "в электронном виде"), $property, true, true) ?>
            <?= load_form_textaea_step2($service_num, 'sr_7', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_8', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_9', array("Юр." => "Юр.", "Физ." => "Физ."), $property, true, true) ?>
            <?= load_form_textaea_step2($service_num, 'sr_10', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_11', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_12', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_13', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_14', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_15', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_16', $property, true); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "по-разному" => "по-разному", "не установлено" => "не установлено"), $property, true) ?>
            <?= load_form_textaea_step2($service_num, 'sr_18', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_19', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_20', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_21', $property, true); ?>
            <?= load_form_textaea_step2($service_num, 'sr_22', $property, true); ?>
            <?= load_form_file_step2($service_num, 'sr_23', $property, true); ?>
            <?= load_form_file_step2($service_num, 'sr_24', $property, true); ?>
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

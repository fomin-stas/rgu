<div class="tab-pane active" id="pane_sk<?= $service_num ?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2($service_num, 'sk_0', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sk_1', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sk_4', $property, false); ?>

            <?= load_form_textaea_step2($service_num, 'sk_12', $property, false); ?>

            <?= load_form_file_step2($service_num, 'sk_23', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sk_27', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sk_29', $property, false); ?>


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

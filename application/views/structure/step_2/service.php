<div class="tab-pane active" id="pane_sr<?=$service_num?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2( $service_num, 'sr_0' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_1' , true); ?>
            <?= load_form_dropdown_step2( $service_num, 'sr_2', $spher , true) ?>
            <?= load_form_dropdown_step2( $service_num, 'sr_3', $organization_provide_service , true, true) ?>
            <?= load_form_textaea_step2( $service_num, 'sr_4' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_5' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_6' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_7' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_8' , true); ?>
            <?= load_form_dropdown_step2( $service_num, 'sr_9', array("Юр." => "Юр.", "Физ." => "Физ.") , true, true) ?>
            <?= load_form_textaea_step2( $service_num, 'sr_10' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_11' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_12' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_13' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_14' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_15' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_16' , true); ?>
            <?= load_form_dropdown_step2( $service_num, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "по-разному" => "по-разному", "не установлено" => "не установлено") , true, true) ?>
            <?= load_form_textaea_step2( $service_num, 'sr_18' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_19' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_20' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_21' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_22' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_23' , true); ?>
            <?= load_form_textaea_step2( $service_num, 'sr_24' , true); ?>
        </div>
    </div>
</div>

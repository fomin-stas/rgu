<div class="tab-pane active" id="pane_sr<?= $service_num ?>">
    <div class="form-horizontal" >
        <div>
            <?= load_form_textaea_step2($service_num, 'sr_0', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sr_1', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_2', $spher, $property, false) ?>
            <?= load_form_dropdown_step2($service_num, 'sr_3', array('Не выбрано'=>'Не выбрано', 'Администрация района'=>'Администрация района', 'Внебюджетный фонд'=>'Внебюджетный фонд', 'Государственное учреждение'=>'Государственное учреждение', 'ГУЖА'=>'ГУЖА', 'Органы местного самоуправления'=>'Органы местного самоуправления', 'Федеральный орган исполнительной власти'=>'Федеральный орган исполнительной власти'), $property, false, false) ?>
            <?= load_form_textaea_step2($service_num, 'sr_4', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_5', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_6', array("в традиционном порядке" => "в традиционном порядке", "через МФЦ" => "через МФЦ", "в электронном виде" => "в электронном виде"), $property, false, true) ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_7', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_8', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_9', array("физические лица" => "физические лица" , "юридические лица" => "юридические лица", "индивидуальные предприниматели" => "индивидуальные предприниматели"), $property, false, true) ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_10', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_11', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_12', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_13', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_14', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_15', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_16', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_17', array("безвозмездно" => "безвозмездно", "возмездно" => "возмездно", "не установлено" => "не установлено"), $property, false,false) ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_18', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_19', $property, false); ?>
            <?= '';//load_form_dropdown_step2($service_num, 'sr_20',array("Да" => "Да" , "Нет" => "Нет"), $property, false, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_21', $property, false); ?>
            <?= '';//load_form_textaea_step2($service_num, 'sr_22', $property, false); ?>
            <?= load_form_file_step2($service_num, 'sr_23', $property, false); ?>
            <?= '';//load_form_file_step2($service_num, 'sr_24', $property, false); ?>
            <?= load_form_dropdown_step2($service_num, 'sr_25', array("Рождение ребенка" => "Рождение ребенка" , "Смена фамилии" => "Смена фамилии", "Индивидуальное жилищное строительство" => "Индивидуальное жилищное строительство","открытие своего дела" => "открытие своего дела","Смена места жительства" => "Смена места жительства","Утрата документов" => "Утрата документов","Потеря или поиск работы" => "Потеря или поиск работы","Утрата близкого человека" => "Утрата близкого человека","Выход на пенсию" => "Выход на пенсию"), $property, false, true) ?>
            <?= load_form_dropdown_step2($service_num, 'sr_26', array("Государственная (муниципальная) услуга" => "Государственная (муниципальная) услуга" , "услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания" => "услуга бюджетного учреждения, предоставляемая на основании государственного (муниципального) задания", "услуга, необходимая и обязательная для предоставления государственной (муниципальной) услуги" => "услуга, необходимая и обязательная для предоставления государственной (муниципальной) услуги"), $property, false, false) ?>
            
            <?= load_form_dropdown_step2($service_num, 'sr_28', array("Да" => "Да" , "Нет" => "Нет"), $property, false, false) ?>
            <?= load_form_textaea_step2($service_num, 'sr_27', $property, false); ?>
            <?= load_form_textaea_step2($service_num, 'sr_29', $property, false); ?>
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

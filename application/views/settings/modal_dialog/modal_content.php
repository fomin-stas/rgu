<?php if($id_property_format == 2):?>
<div class="content_tree col-md-12" id="<?=$type?>_<?=$service_num?>_content_<?=$id_additional_property?>">
    <label for="content_textarea_<?=$id_additional_property?>" class=""><?=$additional_property_name?>:</label>
    <textarea id="<?=$type?>_<?=$service_num?>_content_textarea_<?=$id_additional_property?>" name="additional_<?=$type?>_<?=$service_num?>_content_textarea_<?=$id_additional_property?>" class="col-md-12 form-control"><?=  isset($additional_value)?$additional_value:''?></textarea>
</div>
<?php endif; ?>
<?php if($id_property_format == 3):?>
<div class="content_tree col-md-9" id="<?=$type?>_<?=$service_num?>_content_<?=$id_additional_property?>">
    <label for="content_select_<?=$id_additional_property?>" class=""><?=$additional_property_name?>:</label>
        <?=form_dropdown('additional_'.$type.'_'.$service_num.'_content_select_'.$id_additional_property,isset($options)?$options:'',isset($additional_value)?$additional_value:'','class="col-md-12 form-control dropdown"')?>
</div>
<?php endif; ?>
<?php if($id_property_format == 4):?>
<div class="content_tree col-md-9" id="<?=$type?>_<?=$service_num?>_content_<?=$id_additional_property?>">
    <label for="content_date_<?=$id_additional_property?>" class=""><?=$additional_property_name?>:</label>
    <input id="<?=$type?>_<?=$service_num?>_content_textarea_<?=$id_additional_property?>" name="additional_<?=$type?>_<?=$service_num?>_content_textarea_<?=$id_additional_property?>" class="col-md-12 form-control"><?=  isset($additional_value)?$additional_value:''?></input>
<script>    
    $('#<?=$type?>_<?=$service_num?>_content_textarea_<?=$id_additional_property?>').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        startDate: "-all earlier dates will be disabled",
        language: "ru",
        daysOfWeekDisabled: "0,6",
        autoclose: true,
        todayHighlight: true
    });
</script>
</div>
<?php endif; ?>

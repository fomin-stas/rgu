<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="<?= $name ?>_property_type">Тип родительского свойства</label>
            <select  type="text" class="form-control" id="<?= $name ?>_parent_type" name="parent_type">
                <option value="property" >Свойство</option>
                <option value="property_values" >Значение свойства</option>
                <option value="additional_property" >Дополнительное свойство</option>
                <option value="additional_property_values" >Значение дополнительного свойства</option>
            </select>
        </div>
    </div>
</div>

<!--parent type property-->
<div class="row" id="<?= $name ?>_parent_property" style="display:none">
    <div class="col-md-12">
        <div class="form-group">
            <label for="<?= $name ?>_parent_property_list">Наименование родительского свойства</label>
            <?= form_dropdown($name . "_parent_property_list", $property_select, $select, 'class="form-control" id="' . $name . '_parent_property_list"'); ?> 
        </div>
    </div>
</div>

<!--parent type property_values-->
<div class="row" id="<?= $name ?>_parent_property_values" style="display:none">
    <div class="col-md-12">
        <div class="form-group col-md-6">
            <label for="<?= $name ?>_parent_property_values_list">Наименование свойств со значениями</label>
            <?= form_dropdown($name . "_parent_property_values_list", $property_values_select, $select, 'class="form-control" id="' . $name . '_parent_property_values_list"'); ?> 
        </div>
        <div class="form-group col-md-6" id="<?= $name . "_parent_property_value_group"?>">

        </div>
    </div>
</div>

<!--parent type additional_property-->
<div class="row" id="<?= $name ?>_parent_additional_property" style="display:none">
    <div class="col-md-12">
        <div class="form-group">
            <label for="<?= $name ?>_parent_additional_property_list">Наименование родительского свойства</label>
            <?= form_dropdown($name . "_parent_additional_property_list", $additional_property_select, $select, 'class="form-control" id="' . $name . '_parent_additional_property_list"'); ?> 
        </div>
    </div>
</div>

<!--parent type additional_property_values-->
<div class="row" id="<?= $name ?>_parent_additional_property_values" style="display:none">
    <div class="col-md-12">
        <div class="form-group col-md-6">
            <label for="<?= $name ?>_parent_additional_property_values_list">Наименование свойств со значениями</label>
            <?= form_dropdown($name . "_parent_additional_property_values_list", $additional_property_values_select, $select, 'class="form-control" id="' . $name . '_parent_additional_property_values_list"'); ?> 
        </div>
        <div class="form-group col-md-6" id=<?= $name . "_parent_additional_property_value_group" ?>>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="<?= $name ?>_property_type">Тип родительского свойства</label>
            <select  type="text" class="form-control" id="<?= $name ?>_parent_type" name="parent_type">
                <option value="property" >Свойство</option>
                <option value="property_values" >Значение свойства</option>
                <option value="addition_property" >Дополнительное свойство</option>
                <option value="addition_property_values" >Значение дополнительного свойства</option>
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
        <div class="form-group col-md-6" id=<?=$name . "_parent_property_value_group"?>>
            
        </div>
    </div>
</div>

<!--parent type addition_property-->
<div class="row" id="<?= $name ?>_parent_addition_property" style="display:none">
    <div class="col-md-6">
        <div class="form-group">
            <label for="<?= $name ?>_type_values">Список доп. свойств</label>
            <input type="text" class="form-control" id="<?= $name ?>_type_values" name="<?= $name ?>_type_values">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="<?= $name ?>_type_values_btn"> &nbsp; </label><br />
            <button type="submit" class="form-control btn btn-primary" id="<?= $name ?>_type_values_btn">Добавить значение</button>
        </div>
    </div>
    <div id="<?= $name ?>_type_values_list" class="col-md-12 b-type-values-list"></div>
</div>

<!--parent type addition_property_values-->
<div class="row" id="<?= $name ?>_parent_addition_property_values" style="display:none">
    <div class="col-md-6">
        <div class="form-group">
            <label for="<?= $name ?>_type_values">Список значений</label>
            <input type="text" class="form-control" id="<?= $name ?>_type_values" name="<?= $name ?>_type_values">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="<?= $name ?>_type_values_btn"> &nbsp; </label><br />
            <button type="submit" class="form-control btn btn-primary" id="<?= $name ?>_type_values_btn">Добавить значение</button>
        </div>
    </div>
    <div id="<?= $name ?>_type_values_list" class="col-md-12 b-type-values-list"></div>
</div>

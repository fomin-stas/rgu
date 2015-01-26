<label for='<?= $name ?>_parent_property_value'>Список значений свойства</label>
            <?= form_dropdown($name . '_parent_property_value', $values, isset($select)?$select:'', 'class=\'form-control\' id=\'' . $name . '_parent_property_value_select\''); ?>
<script>
   // $('#<?=$name?>_parent_property_value_select').chosen();
</script>


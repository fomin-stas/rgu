<label for="<?= $name ?>_parent_property_value">Список значений свойства</label>
            <?= form_dropdown($name . "_parent_property_value", $values, '', 'class="form-control" id="' . $name . '_parent_property_value"'); ?>
<script>
    $("#<?=$name?>_parent_property_value").chosen();
</script>


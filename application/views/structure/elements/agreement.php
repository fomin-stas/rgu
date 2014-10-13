<div class="col-sm-9" style="padding-left: 2px">
    <?php foreach ($buttons as $value => $text):?>
    <label>
        <input type="radio" class="ace " value="<?=$value?>" <?=$checked?> name="<?= $id_sirvices . '_' . $id_property ?>"> 
        <span class="lbl">$text</span>
    </label>
    <?php endforeach;?>
</div>

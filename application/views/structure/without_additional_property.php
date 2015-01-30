<div class="container-fluid">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
            <h4 class="modal-title" ><?= $title ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <?=isset($property_content)?$property_content:''?>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div id="<?= $type ?>_<?= $service_num ?>_tree_<?= $id_property ?>" class="tree">
                    Дополнительных свойств нет
                    </div>
                </div>
                <div class="col-md-9">
                    
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
        </div>
    </div>
</div>


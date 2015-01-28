<div class="col-md-1">
    <label class="btn btn-primary addition_property" data-id="<?=$type?>_<?=$service_num?>_div_<?=$id_property?>">
        <i class="icon-only ace-icon fa fa-align-justify"></i>
    </label>
</div>
<div class="modal fade" id="<?=$type?>_<?=$service_num?>_div_<?=$id_property?>" tabindex="-1" role="dialog" aria-labelledby="add_property_label" aria-hidden="true">
<div class="container-fluid">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
            <h4 class="modal-title" ><?= $title ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <div id="<?=$type?>_<?=$service_num?>_tree_<?=$id_property?>" class="tree"></div>
                    <script>
                        var <?=$type?>_<?=$service_num?>_tree_data_<?=$id_property?> = <?=$tree?>

                        var <?=$type?>_<?=$service_num?>_treeDataSource_<?=$id_property?> = new DataSourceTree({data: <?=$type?>_<?=$service_num?>_tree_data_<?=$id_property?>});
           
                        $('#<?=$type?>_<?=$service_num?>_tree_<?=$id_property?>').ace_tree({
                            dataSource: <?=$type?>_<?=$service_num?>_treeDataSource_<?=$id_property?>,
                            multiSelect: false,
                            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
                            'open-icon': 'ace-icon tree-minus',
                            'close-icon': 'ace-icon tree-plus',
                            'selectable': false
                            
                        });
                    </script>
                </div>
                <div class="col-md-9">
                    <?= $content ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Сохранить</button>
        </div>
    </div>
</div>


</div>
<div class="container-fluid">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
            <h4 class="modal-title" ><?= $title ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    <div id="tree_<?=$id_property?>" class="tree"></div>
                    <script>
                        var tree_data = {
                            'for-sale': {"name": 'For Sale', "type": 'folder'},
                            'vehicles': {"name": 'Vehicles', "type": 'folder'},
                            'rentals': {name: 'Rentals', type: 'folder'},
                            'real-estate': {name: 'Real Estate', type: 'folder'},
                            'pets': {name: 'Pets', type: 'folder'},
                            'tickets': {name: 'Tickets', type: 'item'},
                            'services': {name: 'Services', type: 'item'},
                            'personals': {name: 'Personals', type: 'item'}
                        }
                        tree_data['for-sale']['additionalParameters'] = {
                            'children': {
                                'appliances': {name: 'Appliances', type: 'item'},
                                'arts-crafts': {name: 'Arts & Crafts', type: 'item'},
                                'clothing': {name: 'Clothing', type: 'item'},
                                'computers': {name: 'Computers', type: 'item'},
                                'jewelry': {name: 'Jewelry', type: 'item'},
                                'office-business': {name: 'Office & Business', type: 'item'},
                                'sports-fitness': {name: 'Sports & Fitness', type: 'item'}
                            }
                        }
                        tree_data['vehicles']['additionalParameters'] = {
                            'children': {
                                'cars': {name: 'Cars', type: 'folder'},
                                'motorcycles': {name: 'Motorcycles', type: 'item'},
                                'boats': {name: 'Boats', type: 'item'}
                            }
                        }
                        tree_data['vehicles']['additionalParameters']['children']['cars']['additionalParameters'] = {
                            'children': {
                                'classics': {name: 'Classics', type: 'item'},
                                'convertibles': {name: 'Convertibles', type: 'item'},
                                'coupes': {name: 'Coupes', type: 'item'},
                                'hatchbacks': {name: 'Hatchbacks', type: 'item'},
                                'hybrids': {name: 'Hybrids', type: 'item'},
                                'suvs': {name: 'SUVs', type: 'item'},
                                'sedans': {name: 'Sedans', type: 'item'},
                                'trucks': {name: 'Trucks', type: 'item'}
                            }
                        }

                        tree_data['rentals']['additionalParameters'] = {
                            'children': {
                                'apartments-rentals': {name: 'Apartments', type: 'item'},
                                'office-space-rentals': {name: 'Office Space', type: 'item'},
                                'vacation-rentals': {name: 'Vacation Rentals', type: 'item'}
                            }
                        }
                        tree_data['real-estate']['additionalParameters'] = {
                            'children': {
                                'apartments': {name: 'Apartments', type: 'item'},
                                'villas': {name: 'Villas', type: 'item'},
                                'plots': {name: 'Plots', type: 'item'}
                            }
                        }
                        tree_data['pets']['additionalParameters'] = {
                            'children': {
                                'cats': {name: 'Cats', type: 'item'},
                                'dogs': {name: 'Dogs', type: 'item'},
                                'horses': {name: 'Horses', type: 'item'},
                                'reptiles': {name: 'Reptiles', type: 'item'}
                            }
                        }

                        var treeDataSource_<?=$id_property?> = new DataSourceTree({data: tree_data});
           
                        $('#tree_<?=$id_property?>').ace_tree({
                            dataSource: treeDataSource_<?=$id_property?>,
                            multiSelect: false,
                            loadingHTML: '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>',
                            'open-icon': 'ace-icon tree-minus',
                            'close-icon': 'ace-icon tree-plus',
                            'selectable': true
                            
                        });
                        $('#tree_<?=$id_property?>').on('selected.fu.tree', function() {
                            // do something
                            var array_tree=$('#tree_<?=$id_property?>').tree('selectedItems');
                           
                            console.log(array_tree);
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



        <div class="main-container">
            <?if($this->session->flashdata('message')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <?=$this->session->flashdata('message'); ?>
            </div>
            <?endif;?>
            
            <div class="tabbable col-md-12" id="gridTabs">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li class="active">
                        <a href="#properties" data-toggle="tab">Свойства</a>
                    </li>
                    <li>
                        <a href="#users" data-toggle="tab">Пользователи</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" id="properties">
                        <?if(count($properties) > 0):?>
                        <div class="table-responsive">
                          <table class="table" id="properties-table">
                            <thead class="text-center">
                                <tr>
                                    <td>id</td>
                                    <td>Название</td>
                                    <td>Краткое название</td>
                                    <td>Тип</td>
                                    <td>Тип к которому относится</td>
                                    <td>Форматирование</td>
                                    <td>Ширина</td>
                                    <td>Обзателеный</td>
                                    <td>Действия</td>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?foreach((array)$properties as $property): $options = json_decode($property['options'], TRUE);?>
                                <tr id="property_<?=$property['id_property']?>">
                                    <td><?=$property['id_property']?></td>
                                    <td><?=$property['property_name']?></td>
                                    <td><?=$property['property_short_name']?></td>
                                    <td><?=$property['format']['property_format_name']?></td>
                                    <td><?=$service_types[$property['id_service_type']]['service_type_name']?></td>
                                    <td><?=$options['property_align']?></td>
                                    <td><?=$options['property_width']?></td>
                                    <td>
                                        <?if($options['property_required']):?>
                                            <span class="badge badge-success">Да</span>
                                        <?else:?>
                                            <span class="badge badge-danger">Нет</span>
                                        <?endif;?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-primary btn-sm a-edit" data-id="<?=$property['id_property']?>">
                                            <i class="fa fa-pencil"></i> Редактировать
                                          </button>
                                          <button type="button" class="btn btn-danger btn-sm a-remove" data-id="<?=$property['id_property']?>">
                                            <i class="fa fa-times"></i> Удалить
                                          </button>
                                        </div>
                                    </td>
                                </tr>
                                <?endforeach;?>
                            </tbody>
                          </table>
                        </div>
                        <div class="row text-center">
                            <?=$pages;?>
                        </div>
                        <?else:?>
                        <h2>В базе нет ни одного свойства, пожалуйста добавьте их.</h2>
                        <?endif;?>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add_property">
                          Добавить новое свойство
                        </button>

                    </div>
                    <div class="tab-pane" id="users">
                       
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="add_property" tabindex="-1" role="dialog" aria-labelledby="add_property_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="add_property_label">Добавить новое свойство</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?=form_open('settings/index#add_property'); ?>
                                <?=validation_errors(); ?>
                                    <div class="form-group">
                                        <label for="add_property_name">Название свойства</label>
                                        <input type="text" class="form-control" id="add_property_name" name="property_name" placeholder="Название свойства" value="<?=set_value('property_name')?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="add_property_short_name">Краткое название свойства</label>
                                        <input type="text" class="form-control" id="add_property_short_name" name="property_short_name" placeholder="Краткое название свойства" value="<?=set_value('property_short_name')?>">
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="add_property_type">Тип свойства</label>
                                            <select  type="text" class="form-control" id="add_property_type" name="property_type">
                                                <option value="1" <?php echo set_select('property_type', '1', TRUE); ?> >Системное</option>
                                                <option value="2" <?php echo set_select('property_type', '2'); ?> >Тесковое поле (многострочное)</option>
                                                <option value="3" <?php echo set_select('property_type', '3'); ?> >Выпадающий список</option>
                                                <option value="4" <?php echo set_select('property_type', '4'); ?> >Дата</option>
                                                <option value="5" <?php echo set_select('property_type', '5'); ?> >Число</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="add_property_align">Выравнивание свойства</label>
                                            <select  type="text" class="form-control" id="add_property_align" name="property_align">
                                                <option value="center" <?php echo set_select('property_align', 'center', TRUE); ?> >по центру</option>
                                                <option value="left" <?php echo set_select('property_align', 'left'); ?> >слева</option>
                                                <option value="right" <?php echo set_select('property_align', 'right'); ?> >справа</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_property_width">Ширина поля</label>
                                                <input type="text" class="form-control" id="add_property_width" name="property_width" placeholder="Ширина поля" value="<?=set_value('property_width', 200)?>">
                                                <span class="help-block">По умолчанию 200px</span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_property_color">Цвет свойства</label>
                                                <input type="text" class="form-control" id="add_property_color" name="property_color" placeholder="Цвет" value="<?=set_value('property_color', '#FFFFFF')?>">
                                                <span class="help-block">По умолчанию белый</span>
                                            </div>  
                                          </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_service_type">Тип</label>
                                                <select  type="text" class="form-control" id="add_service_type" name="service_type">
                                                    <?foreach ((array)$service_types as $type):?>
                                                    <option value="<?=$type['id_service_type']?>" <?php echo set_select('service_type', $type['id_service_type']); ?> ><?=$type['service_type_name']?></option>
                                                    <?endforeach;?>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            
                                          </div>
                                    </div>
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="property_required" id="add_property_required" <?php echo set_checkbox('property_required', '1'); ?>> Свойство обязательно для заполнения?
                                    </label>
                                  </div>
                                  <input type="hidden" name="method" value="add">
                                  <button type="submit" class="btn btn-default">Добавить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit_property" tabindex="-1" role="dialog" aria-labelledby="edit_property_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="edit_property_label">Редактировать свойство</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?=form_open('settings/index#edit_property'); ?>
                                <?=validation_errors(); ?>
                                    <div class="form-group">
                                        <label for="edit_property_name">Название свойства</label>
                                        <input type="text" class="form-control" id="edit_property_name" name="property_name" placeholder="Название свойства" value="<?=set_value('property_name')?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_property_short_name">Краткое название свойства</label>
                                        <input type="text" class="form-control" id="edit_property_short_name" name="property_short_name" placeholder="Краткое название свойства" value="<?=set_value('property_short_name')?>">
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_property_type">Тип свойства</label>
                                            <select  type="text" class="form-control" id="edit_property_type" name="property_type">
                                                <option value="1" <?php echo set_select('property_type', '1', TRUE); ?> >Системное</option>
                                                <option value="2" <?php echo set_select('property_type', '2'); ?> >Тесковое поле (многострочное)</option>
                                                <option value="3" <?php echo set_select('property_type', '3'); ?> >Выпадающий список</option>
                                                <option value="4" <?php echo set_select('property_type', '4'); ?> >Дата</option>
                                                <option value="5" <?php echo set_select('property_type', '5'); ?> >Число</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_property_align">Выравнивание свойства</label>
                                            <select  type="text" class="form-control" id="edit_property_align" name="property_align">
                                                <option value="center" <?php echo set_select('property_align', 'center', TRUE); ?> >по центру</option>
                                                <option value="left" <?php echo set_select('property_align', 'left'); ?> >слева</option>
                                                <option value="right" <?php echo set_select('property_align', 'right'); ?> >справа</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="edit_property_width">Ширина поля</label>
                                                <input type="text" class="form-control" id="edit_property_width" name="property_width" placeholder="Ширина поля" value="<?=set_value('property_width', 200)?>">
                                                <span class="help-block">По умолчанию 200px</span>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_property_color">Цвет свойства</label>
                                                <input type="text" class="form-control" id="edit_property_color" name="property_color" placeholder="Цвет" value="<?=set_value('property_color', '#FFFFFF')?>">
                                                <span class="help-block">По умолчанию белый</span>
                                            </div>  
                                          </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="edit_service_type">Тип</label>
                                                <select  type="text" class="form-control" id="edit_service_type" name="service_type">
                                                    <?foreach ((array)$service_types as $type):?>
                                                    <option value="<?=$type['id_service_type']?>" <?php echo set_select('service_type', $type['id_service_type']); ?> ><?=$type['service_type_name']?></option>
                                                    <?endforeach;?>
                                                </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            
                                          </div>
                                    </div>
                                  <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="property_required" id="edit_property_required" <?php echo set_checkbox('property_required', '1'); ?>> Свойство обязательно для заполнения?
                                    </label>
                                  </div>
                                  <input type="hidden" name="id_property" id="edit_id_property">
                                  <input type="hidden" name="method" value="edit">
                                  <button type="submit" class="btn btn-default">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
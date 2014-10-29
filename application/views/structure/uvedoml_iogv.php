        <div class="main-container">
            <div class="tabbable col-md-12">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li class="active">
                        <a href="#new_notifications" data-toggle="tab">Новые (<?=count($notifications)?>)</a>
                    </li>
                    <li>
                        <a href="#archived_notifications" data-toggle="tab">Архив (<?=count($archived_notifications)?>)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" id="new_notifications">
                        <?if(count($notifications) > 0):?>
                        <form action="" method="post" charset="utf-8">
                        <div class="table-responsive">
                              <table class="table" id="properties-table">
                                <thead class="text-center">
                                    <tr>
                                        <td><input type="checkbox" id="selectAll"></td>
                                        <td>id</td>
                                        <td>Наименование полномочия в соответствии с положением ИОГВ</td>
                                        <td>Наименование государственной функции (услуги)</td>
                                        <td>Уведомление</td>
                                        <td>Дата уведомления</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?foreach((array)$notifications as $notification):?>
                                    <tr id="notification_<?=$notification['id_activity_feed']?>">
                                        <td><input type="checkbox" id="notification_select_<?=$notification['id_activity_feed']?>" name="selectedItems[]" value="<?=$notification['id_activity_feed']?>" class="delete_trigger"></td>
                                        <td><?=$notification['id_activity_feed']?></td>
                                        <td><a href="structure/check_status_authority/<?=$notification['id_object'] ?>"><?=$notification['authority']['authority_name']?></a></td>
                                        <td><?php if(isset($notification['service']['service_name'])) echo $notification['service']['service_name'];?></td>
                                        <td style="color:<?=$notification['message']['color']?>"><?=$notification['message']['text']?></td>
                                        <td><?=$notification['time']?></td>
                                        <!--<td><input type="checkbox" id="notification_select_<?=$notification['id_activity_feed']?>" name="selectedItems[]" value="<?=$notification['id_activity_feed']?>" class="delete_trigger"></td>
                                        <td><?=$notification['id_activity_feed']?></td>
                                        <td><?=$notification['authority']['authority_name']?></td>
                                        <td><?php if(isset($notification['service']['service_name'])) echo $notification['service']['service_name'];?></td>
                                        <td style="color:<?=$notification['message']['color']?>"><?=$notification['message']['text']?></td>
                                        <td><?=$notification['time']?></td>-->
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                              </table>
                            </div>
                         <button type="submit" class="btn">Перенести в архив</button>
                         </form>
                        <?else:?>
                        <h2>У вас нет уведомлений.</h2>
                        <?endif;?>
                    </div>
                    <div class="tab-pane" id="archived_notifications">
                        <div class="tab-pane in active" id="new_notifications">
                        <?if(count($archived_notifications) > 0):?>
                        <div class="table-responsive">
                              <table class="table" id="properties-table">
                                <thead class="text-center">
                                    <tr>
                                        <td>id</td>
                                        <td>Наименование полномочия в соответствии с положением ИОГВ</td>
                                        <td>Наименование государственной функции (услуги)</td>
                                        <td>Уведомление</td>
                                        <td>Дата уведомления</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?foreach((array)$archived_notifications as $archived_notification):?>
                                    <tr id="archived_notification_<?=$archived_notification['id_activity_feed']?>">
                                        <td><?=$archived_notification['id_activity_feed']?></td>
                                        <td><?=$archived_notification['authority']['authority_name']?></td>
                                        <td><?php if(isset($archived_notification['service']['service_name'])) echo $archived_notification['service']['service_name'];?></td>
                                        <td style="color:<?=$archived_notification['message']['color']?>"><?=$archived_notification['message']['text']?></td>
                                        <td><?=$archived_notification['time']?></td>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                              </table>
                            </div>
                        <?else:?>
                        <h2>У вас нет уведомлений.</h2>
                        <?endif;?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="main-container">
            <div class="tabbable col-md-12">
                <ul class="nav nav-tabs tab-color-blue background-blue padding-12">
                    <li class="active">
                        <a href="#new_notifications" data-toggle="tab">Новые (<?=count($notifications)?>)</a>
                    </li>
                    <li>
                        <a href="#arch" data-toggle="tab">Архив (0)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane in active" id="new_notifications">
                    	<?if(count($notifications) > 0):?>
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
                                <?foreach((array)$notifications as $notification):?>
                                <tr id="notification_<?=$notification['id_activity_feed']?>">
                                    <td><?=$notification['id_activity_feed']?></td>
                                    <td><?=$notification['authority']['authority_name']?></td>
                                    <td><?php if(isset($notification['service']['service_name'])) echo $notification['service']['service_name'];?></td>
                                    <td style="color:<?=$notification['message']['color']?>"><?=$notification['message']['text']?></td>
                                    <td><?=$notification['time']?></td>
                                </tr>
                                <?endforeach;?>
                            </tbody>
                          </table>
                        </div>
                        <div class="row text-center">
                        </div>
                        <?else:?>
                        <h2>У вас нет уведомлений.</h2>
                        <?endif;?>
                    </div>
                    <div class="tab-pane" id="archived_notifications">
                    	
                    </div>
                </div>
            </div>
        </div>
        

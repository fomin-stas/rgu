<div class="main-container">
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
                        <td>Событие</td>
                        <td>Дата события</td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?foreach((array)$notifications as $notification):?>
                    <tr id="notification_<?= $notification['id_activity_feed'] ?>">
                        <td><input type="checkbox" id="notification_select_<?= $notification['id_activity_feed'] ?>" name="selectedItems[]" value="<?= $notification['id_activity_feed'] ?>" class="delete_trigger"></td>
                        <td><?= $notification['id_activity_feed'] ?></td>
                        <td><a href="structure/check_status_authority/<?= $notification['id_object'] ?>"><?= $notification['authority']['authority_name'] ?></a></td>
                        <td><?php if (isset($notification['service']['service_name'])) echo $notification['service']['service_name']; ?></td>
                        <td style="color:<?= $notification['message']['color'] ?>"><?= $notification['message']['text'] ?></td>
                        <td><?= $notification['time'] ?></td>
                    </tr>
                    <?endforeach;?>
                </tbody>
            </table>

            <?else:?>
            <h2>У вас нет истории данного полномочия.</h2>
            <?endif;?>
        </div>

</div>



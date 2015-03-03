<div>
    <label for="serp_<?= $id_service_property ?>">Комментарий к свойству:</label>
    <textarea class="form-control" placeholder="Ведите комментарий" id="serp_<?= $id_service_property.'_'.$num ?>" value=""></textarea>
    <br>
    <input type="button" class="btn btn-info" id="cbtn_<?= $id_service_property.'_'.$num ?>" value="Сохранить"></input>
</div>
<div class="profile-feed">
  <?php foreach ($property_comments as $comment): ?> 
  <div class="profile-activity clearfix">
    <div>
        <a class="user" href="#"><?=$comment['user']?></a>
        <?=$comment['comment']?>
        <div class="time"><i class="ace-icon fa fa-clock-o bigger-110"></i> <?=$comment['date_comment']?></div>
    </div>
  </div>
    <?php endforeach; ?>
</div>

<script>
        $('#cbtn_<?= $id_service_property.'_'.$num ?>').click(function() {
        //сделать ajax запрос за коментариями
        id = $(this).attr('id');
        comment=$('#serp_<?= $id_service_property.'_'.$num ?>').val();
        data_comment='id='+id+'&comment='+comment;
        $.ajax({
            url: 'ajax/insert_comments/',
            type: 'post',
            data: data_comment,
            success: function(data) {
                    $('#<?=$id?>').children('.badge-left').text(Number($('#<?=$id?>').children('.badge-left').text())+1);
                    $.gritter.removeAll();
                }
            });
        });
    

</script>
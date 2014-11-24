
<div class="main-container">
    <div class="col-md-10 col-md-offset-1">
        <!-- Timeline -->
        <?php if (is_array($comments_data)): ?>
            <div class="timeline-container">

                <?php foreach ($comments_data as $date => $messages): ?>
                    <div class="timeline-label">
                        <span class="label label-primary arrowed-in-right label-lg">
                            <b><?= $date; ?></b>
                        </span>
                    </div>
                    <?php foreach ($messages as $item): ?>
                        <div class="timeline-items">    
                            <div class="timeline-item clearfix">
                                <div class="timeline-info">
                                    <span class="label label-info label-sm"><?= $item['user_name']; ?></span>
                                </div>
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-small">
                                        <h5 class="widget-title smaller"><span class="grey"></span></h5>
                                        <span class="widget-toolbar no-border">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            <?= $item['time']; ?>
                                        </span>
                                        <span class="widget-toolbar">
                                            <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                        </span>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <?= $item['message'] ?>
                                            <div class="space-6"></div>
                                            <div class="widget-toolbox clearfix">
                                                <div class="pull-right action-buttons">
                                                    <a href="#"><i class="ace-icon fa fa-pencil-square blue bigger-125"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
        <h3> Нет комментариев</h3>
        <?php endif; ?>
    </div>
</div>


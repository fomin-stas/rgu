<div class="modal-dialog">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h4 class="center">
                                История изменений
                                <input type="text" id="timeline_search_input" class="pull-right input-sm">
                                <i class="ace-icon fa fa-search nav-search-icon pull-right"></i>
                            </h4>
                            <?if(count($history_log) > 0):?>
                            <div class="timeline-container">
                                   <?foreach($history_log as $item):?> 
                                   <div class="timeline-label">
                                        <span class="label label-primary arrowed-in-right label-lg">
                                            <b><?=date('d-m-Y', strtotime($item['time']))?></b>
                                        </span>
                                    </div>
                                    <div class="timeline-items">
                                        <div class="timeline-item clearfix">
                                            <div class="timeline-info">
                                                <span class="label label-info label-sm">Комитет</span>
                                            </div>
                                            <div class="widget-box widget-color-blue">
                                                <div class="widget-header widget-header-small">
                                                    <h5 class="widget-title smaller"><span class="grey"></span></h5>
                                                    <span class="widget-toolbar no-border">
                                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                         <?=date('h:m', strtotime($item['time']))?>
                                                    </span>
                                                    <span class="widget-toolbar">
                                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                                    </span>
                                                </div>
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?=$item['new']?>
                                                        <div class="space-6"></div>
                                                        <div class="widget-toolbox clearfix">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?if(NULL != $item['old']):?>    
                                        <div class="timeline-item clearfix">
                                            <div class="timeline-info">
                                                <span class="label label-info label-sm">Комитет</span>
                                            </div>
                                            <div class="widget-box widget-color-purple">
                                                <div class="widget-header widget-header-small">
                                                    <h5 class="widget-title smaller">Изменено</h5>
                                                    <span class="widget-toolbar no-border">
                                                         <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                         <?=date('h:m', strtotime($item['time']))?>
                                                    </span>
                                                    <span class="widget-toolbar">
                                                        <a href="#" data-action="collapse"><i class="ace-icon fa fa-chevron-up"></i></a>
                                                    </span>
                                                </div>
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?=$item['old']?>
                                                        <div class="space-6"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?endif;?>    
                                    </div>
                                   <?endforeach;?> 
                                

                                
                            </div>
                            <?else:?>
                            <h3>История изменений пуста</h3>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
<?php //pr($content)?>
<?php if(!empty($content[0]['status'])){ ?>
<ul class="timeline">
    <?php foreach ($content as $key => $value) { ?>
        <li>
            <i class="fa <?= $key==0 ? "focus" : ""?>"></i>
            <div class="timeline-item well">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$value['date']." ".$value['time']?></span>
                <h3 class="timeline-header"><?=$value['status']?> 
                    <div style="color: #c24210;"><?=!empty($value['where']) ? $value['where'] : "" ?></div>
                </h3>
            </div>
        </li>
    <?php }?>
    
<!--    <li>
        <i class="fa"></i>
        <div class="timeline-item well">
            <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
        </div>
    </li>
    <li>
        <i class="fa"></i>
        <div class="timeline-item well">
            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
            <div class="timeline-body">
                Take me to your leader!
                Switzerland is small and neutral!
                We are more like Germany, ambitious and misunderstood!
            </div>
            <div class="timeline-footer">
                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
            </div>
        </div>
    </li>-->
</ul>
<?php }else{ ?>

<div class="well" >                         
    <div  class="font14"><strong>{{ trans('common.No Data') }}</strong></div> 
</div>

<?php } ?>
<div class="clearfix"></div>

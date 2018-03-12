<?php if(!empty($navigator)){ ?>
<div class="breadcrumb-container">
    <div class="container">
        <ol class="breadcrumb">
            <?php 
            foreach ($navigator as $key => $value) {
                if(isset($value['url'])){ ?>
                <li><a href="{{ url($value['url']) }}">{{ $value['text'] }}</a></li>
                <?php }else{ ?>
                <li class="active">{{ $value['text'] }}</li>
                <?php }
            }?>
            
            
        </ol>
    </div>
</div>
<?php } ?>
<div class="row image-row">
    
    <div  class="imagezone image_from_db dz-clickable dz-started">
        <?php  if (!$images->isEmpty()){ ?>
        <?php foreach ($images as $key => $value) { ?>  
        <div class="dz-preview dz-success" id="image_id_{{ $value->id }}">
            <div class="dz-details">    
<!--                <div class="dz-filename"><span data-dz-name="">318184.jpg</span></div>
                <div class="dz-size" data-dz-size="">35.8 KB</div>-->
                <img data-dz-thumbnail="" alt="" data-src="" src="{{ ImgProduct($value->id, $value->new_name150) }}" >  
            </div>  
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
            <!--<div class="dz-success-mark"><span>✔</span></div>-->  
            <!--<div class="dz-error-mark"><span>✘</span></div>-->  
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
            <div class="select_frame"></div>

        </div>
        <?php }?>
        <?php }else{?>
        <div style="margin-top: 30px;margin-bottom: 30px;text-align: center">ไม่พบรูปในโฟลเดอร์นี้ !!</div>

        <?php }?>
    </div>
</div>
<div class="text-center paginate_image" for="{{ Request::segment(4) }}">
    <nav>
     {!! $images->appends( Request::query() )->render() !!}
    </nav>
</div>


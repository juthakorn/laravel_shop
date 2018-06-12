<div class="row image-row">    
    <div  class="imagezone storeimg dz-clickable dz-started" style="cursor: auto;">
        <?php  if (!$images->isEmpty()){ ?>
        <?php foreach ($images as $key => $value) { ?>  
        <div class="dz-preview " id="image_id_{{ $value->id }}">
            <div class="dz-details" style="margin-bottom: 22px;background: #000;">  
                <div class="dz-size" data-dz-size="">{{ $value->size }}</div>
                
                <?php
                if(file_exists(str_replace(url("/")."/", "", ImgProduct($value->id, $value->new_name150)))){ ?>   
                    <a  href="{{ ImgProduct($value->id, $value->new_name) }}" data-imagelightbox="gallery" class="gallery-item">
                        <img src="{{ ImgProduct($value->id, $value->new_name150) }}" alt=""> 
                        <i class="glyphicon glyphicon-search"></i>                                   
                    </a>                                        
                <?php }else{ ?>                
                    <a  href="{{ ImgNoProduct() }}" data-imagelightbox="gallery" class="gallery-item">
                        <img src="{{ ImgNoProduct() }}" alt="">       
                        <i class="glyphicon glyphicon-search"></i>                      
                    </a>
                <?php } ?> 

               

            </div>  
            <button class="btn btn-sm btn-block" onclick="RemoveImg(<?=$value->id;?>)">Remove file</button>
            <!--<div class="dz-success-mark"><span>✔</span></div>-->
            <!--<div class="dz-error-mark"><span>✘</span></div>-->  
            <!--<div class="select_frame"></div>-->

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


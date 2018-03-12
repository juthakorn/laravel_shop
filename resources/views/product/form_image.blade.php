<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="glyphicon glyphicon-picture"></i> ภาพสินค้า</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom image-manger">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">อัพโหลด</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">เลือกจากคลังรูปภาพ</a></li> 
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-inline form-album"  >
                                <div class="form-group">
                                    <label for="exampleInputName2"  style="font-weight: normal;">อัพโหลดรูปภาพเข้าในโฟลเดอร์ </label>
                                    {!! Form::select('album_id', App\Model\Album::pluck('album_name', 'id'), null, ['class' => 'form-control','id'=>'album_id','onchange'=>'setval()']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="album_name" style="font-weight: normal;">สร้างโฟลเดอร์ใหม่ </label>
                                    <input type="text" class="form-control" id="album_name" name="album_name" >
                                </div>
                                <a href="#" id="add-new-album" class="btn btn-default">
                                    <i class="glyphicon glyphicon-ok"></i> สร้าง
                                </a>
                            </div>
                            <form action="{{ url('admin/image/saveimg') }}" class="dropzone" id="my-dropzone">{{ csrf_field() }}
                                <input type="hidden" name="album_id" id="album_id_hidden" >
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="nav-tabs-custom tabbable">
                                <ul class="nav nav-tabs">
                                    <?php foreach ($Album as $key => $value) { ?>
                                        <li class="{{ $key == 0 ? "active" : "" }}"><a href="#to-{{ $value->id }}" album="{{ $value->id }}" data-toggle="tab">{{ $value->album_name }}</a></li>
                                    <?php } ?> 
                                </ul>
                                <div class="tab-content">                                            
                                    <?php foreach ($Album as $key => $value) { ?>    
                                        <div class="tab-pane {{ $key == 0 ? "active" : "" }}" id="to-{{ $value->id }}">
                                            {{ $value->album_name }}

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->


<!--                <div id="laf-selected">

                    <div class="selected_text">เลือกอยู่<br><span class="txt_num_img">2</span> ไฟล์</div>
                    <div class="image_zone"></div>						
                </div>-->
                
                
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="glyphicon glyphicon-picture"></i> เลือกอยู่ <span class="txt_num_img">0</span> ไฟล์</h3>
                </div>
                <div  class="imagezone image_zone parent-image">
                    <?php 
//                    pr($product->image_stores()->orderBy('product_images.id', "asc")->get());
//                    pr($product->image_stores->toArray());
                    if(!empty($product->id)){
                        if(!$product->image_stores->isEmpty()){
                        foreach ($product->image_stores()->orderBy('product_images.position', "asc")->get() as $key_img => $value_img) { ?>
                        <div class="dz-preview image_use" id="<?=$value_img->id?>">
                            <div class="dz-details">
                                <img data-dz-thumbnail="" alt="" data-src="" src="<?=ImgProduct($value_img->id, $value_img->new_name150)?>" >
                            </div>
                            <div class="select_frame"></div>
                            <input type="hidden" name="product_image[<?=$key_img?>][id]" form="frmproduct" class="hidden_id" value="<?=$value_img->pivot->id; ?>" >
                            <input type="hidden" name="product_image[<?=$key_img?>][product_id]" form="frmproduct" value="<?=$value_img->pivot->product_id?>" >
                            <input type="hidden" name="product_image[<?=$key_img?>][image_store_id]" form="frmproduct" class="hidden_image_store_id"  value="<?=$value_img->id?>" >
                            <button type="button" class="closeImg"><span>x</span></button>
                        </div>
                        

                        <?php }
                        }
                    }?>
                </div>
                
            </div>
            <!-- /.box-body -->
            <div class="overlay" style="display: none">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="box-footer">   
            <div class="pull-right">
                <button type="submit" class="btn btn-info" form="frmproduct" >บันทึก</button>
                <button type="reset" class="btn btn-default" form="frmproduct">ยกเลิก</button>
            </div>
        </div>                
    </div>
</div>

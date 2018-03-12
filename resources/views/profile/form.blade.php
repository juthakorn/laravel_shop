
<!-- form start -->
{!! Form::model($address_shop, ['route' => ['profile.update', $address_shop->id], 'method' => 'PATCH', 'files' => true, 'id'=>'frmprofile', 'class'=>'form-horizontal']) !!}

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title" id="box-title"><i class="fa fa-pencil"></i> ข้อมูลร้านค้าทั่วไป</h3>
    </div>
    <div id="body-form" >                    
        <!-- Horizontal Form -->
        <div class="box-body">
            
            <div class="form-group" style="text-align: center">
                <img class="img-thumbnail" id="logo" src="<?=!empty($address_shop->image_logo->id) ? ImgProduct($address_shop->image_logo->id, $address_shop->image_logo->new_name) : "/image/nopicture.png"?>" data-holder-rendered="true" style=" height: 200px;">
                {!! Form::hidden('image_store_id', null, ['id'=>'image_store_id']) !!}  
            </div>
            <div class="form-group" style="text-align: center">
                               
                <button type="button" id="remove-img" <?=!empty($address_shop->image_logo->id) ? "" : "style=\"display: none\"" ?> class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i> นำออก</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-picture"></i> เลือกภาพ</button>
            </div>
            <div class="form-group">
                <label for="shop_name" class="col-sm-2 control-label required_field">ชื่อร้านค้า</label>
                <div class="col-sm-10">
                    {!! Form::text('shop_name', null, ['class' => 'form-control','id'=>'shop_name', 'required'=>'true']) !!}  
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label required_field">แนะนำร้านค้า</label>

                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['class' => 'form-control','id'=>'description', 'rows'=>'4', 'required'=>'true']) !!}                                   
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label required_field">Email</label>
                <div class="col-sm-10">
                    {!! Form::text('email', null, ['class' => 'form-control','id'=>'email', 'required'=>'true']) !!}  
                </div>
            </div>
            <div class="form-group">
                <label for="tel" class="col-sm-2 control-label required_field">โทร</label>
                <div class="col-sm-10">
                    {!! Form::text('tel', null, ['class' => 'form-control','id'=>'tel', 'required'=>'true']) !!}  
                </div>
            </div>
            {!! Form::hidden('id') !!}
        </div>             

    </div><!-- /#body-form -->
    <div class="overlay" style="display: none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div><!-- /.box -->


<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title" id="box-title"><i class="glyphicon glyphicon-map-marker"></i> ข้อมูลการติดต่อ</h3>
    </div>
    <div id="body-form" >                    
        <!-- Horizontal Form -->
        <div class="box-body">            
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label required_field">ที่อยู่</label>
                <div class="col-sm-10">
                    {!! Form::textarea('address', null, ['class' => 'form-control','id'=>'address', 'rows'=>'4', 'required'=>'true']) !!}                                   
                </div>
            </div>
            <div class="form-group">
                <label for="district" class="col-sm-2 control-label required_field">แขวง/ตำบล </label>
                <div class="col-sm-10">
                    {!! Form::text('district', null, ['class' => 'form-control','id'=>'district', 'required'=>'true']) !!}  
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label required_field">เขต/อำเภอ</label>
                <div class="col-sm-10">
                    {!! Form::text('city', null, ['class' => 'form-control','id'=>'city', 'required'=>'true']) !!}  
                </div>
            </div>

            <div class="form-group">
                <label for="province" class="col-sm-2 control-label required_field">จังหวัด</label>
                <div class="col-sm-10">
                    {!! Form::select('province',$province, null, ['class' => 'form-control','id'=>'province', 'required'=>'true']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="postcode" class="col-sm-2 control-label required_field">รหัสไปรษณีย์</label>
                <div class="col-sm-3">
                    {!! Form::text('postcode', null, ['class' => 'form-control','id'=>'postcode', 'required'=>'true']) !!}  
                </div>
            </div>
            <div class="form-group">
                <label for="google_map" class="col-sm-2 control-label required_field">Google Maps (iframe)</label>
                <div class="col-sm-10">
                    {!! Form::textarea('google_map', null, ['class' => 'form-control','id'=>'google_map', 'rows'=>'4', 'required'=>'true']) !!}                                   
                </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 control-label "></label>
            <div class="col-sm-6 embed-responsive embed-responsive-4by3" style="margin-left: 14px;height: 50%" >
                <?= !empty($address_shop->google_map) ? $address_shop->google_map : ""; ?>
            </div>
            </div>
        </div>             

    </div><!-- /#body-form -->
    <div class="overlay" style="display: none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div><!-- /.box -->

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title" id="box-title"><i class="glyphicon glyphicon-map-marker"></i> โซเชียลของร้านค้า</h3>
    </div>
    <div id="body-form" >                    
        <!-- Horizontal Form -->
        <div class="box-body">            
            

            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-8">
                    <div class="input-group ">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-facebook"><i class="fa fa-facebook"></i></button>
                        </div>
                            {!! Form::text('social_facebook', null, ['class' => 'form-control','id'=>'social_facebook']) !!}    
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-8">
                    <div class="input-group social">
                        <div class="input-group-btn">
                          <i class="icon icon-line"></i>
                        </div>
                         {!! Form::text('social_line', null, ['class' => 'form-control','id'=>'social_line']) !!} 
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-8">
                    <div class="input-group ">
                        <div class="input-group-btn">
                          <button type="button" class="btn btn-instagram"><i class="fa fa-instagram"></i></button>
                        </div>
                            {!! Form::text('social_instagram', null, ['class' => 'form-control','id'=>'social_instagram']) !!}    
                    </div>
                </div>
            </div>
        </div>             

    </div><!-- /#body-form -->
    <div class="overlay" style="display: none">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div><!-- /.box -->


<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title" ><i class="fa fa-line-chart"></i> ตั้งค่า SEO ของร้านค้า</h3>
    </div>
    <div class="box-body">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="seo_title" class="col-sm-2 control-label">Title</label>

                <div class="col-sm-10">
                    {!! Form::text('seo_title', null, ['class' => 'form-control','id'=>'seo_title']) !!}                                   
                </div>
            </div>                        
            <div class="form-group">
                <label for="seo_keyword" class="col-sm-2 control-label">Keyword</label>

                <div class="col-sm-10">
                    {!! Form::text('seo_keyword', null, ['class' => 'form-control', 'id'=>'seo_keyword']) !!} 
                </div>
            </div> 
            <div class="form-group">
                <label for="seo_description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    {!! Form::text('seo_description', null, ['class' => 'form-control','id'=>'seo_description']) !!} 
                </div>
            </div> 
        </div> 
    </div>
</div><!-- /.box -->

{!! Form::close() !!}



<!----include image-gallery ---->
@include("partials.image-gallery-modal")
<!----/include image-gallery ---->



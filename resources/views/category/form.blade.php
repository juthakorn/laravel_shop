{!! Form::model($category, [
    'route' => !empty($category->id) ? ['category.update', $category->id] : 'category.store',
    'method' => !empty($category->id) ? 'PUT' : 'POST',
    'files' => true
]) !!}

<div class="col-md-12">
    @include("partials.alert-session")
</div>
            

<div class="col-md-8">


    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" >ข้อมูลทั่วไปของหมวดหมู่</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="cat_name" class="col-sm-3 control-label required_field">ชื่อหมวดหมู่</label>

                    <div class="col-sm-9">
                        {!! Form::text('cat_name', null, ['class' => 'form-control','id'=>'cat_name', 'required'=>'true']) !!}                                   
                    </div>
                </div> 
                <div class="form-group">
                    <label for="category_id" class="col-sm-3 control-label">หมวดหมู่ย่อยของ</label>

                    <div class="col-sm-9">
                        {!!  Form::select('parent_id',$MainCategory, null, ['class' => 'form-control','id'=>'parent_id']) !!}
                    </div>                    
                </div>
                <div class="col-sm-offset-3 col-sm-9 font13"><p>** หากต้องการสร้างหมวดหมู่หลัก "หมวดหมู่ย่อยของ:" ให้เว้นว่างไว้</p></div>
            </div>    
        </div>

    </div><!-- /.box -->


    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" >ข้อมูลอื่นๆ</h3>
        </div>
        <div class="box-body">
            {!! Form::textarea('detail', null, ['class'=>'tinymce']) !!}  

        </div>

    </div><!-- /.box -->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" ><i class="fa fa-line-chart"></i> ตั้งค่า SEO ของหมวดหมู่</h3>
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
                        {!! Form::text('seo_keyword', null, ['class' => 'form-control','id'=>'seo_keyword']) !!} 
                    </div>
                </div> 
                <div class="form-group">
                    <label for="seo_description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        {!! Form::text('seo_description', null, ['class' => 'form-control','id'=>'seo_description']) !!} 
                    </div>
                </div> 
            </div> 
            <div class="col-sm-offset-2 col-sm-10 font13"><p>หากเว้นว่างไว้ ระบบจะกรอกข้อมูลจากรายละเอียดของหมวดหมู่ให้อัตโนมัติ</p></div>
        </div>
    </div><!-- /.box -->

</div><!--/.col -->

<div class="col-md-4">


    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" >การแสดงผลหมวดหมู่</h3>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">                            
                    <label for="active" class="col-sm-4 control-label">สถานะ</label>
                    <div class="col-sm-8">
                        {!! Form::checkbox('active', 1,null, ['class'=>'jscheckbox', 'data-on-text'=>'แสดง','data-off-text'=>'ไม่แสดง']) !!} 
                        
                    </div>
                </div>
            </div> 

        </div>
    </div><!-- /.box -->

    
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title" >ภาพหมวดหมู่</h3>
        </div>
        <div class="box-body">
            
            <div class="box-body">
                <div class="form-horizontal">                    
                    <div class="image_zone">
                        <div class="image_area">
                            <div class="image_frame">
                                <img id="logo" src="<?=!empty($category->image_logo->id) ? ImgProduct($category->image_logo->id, $category->image_logo->new_name) : url("/image/nopicture.png") ?>">

                                {!! Form::hidden('image_store_id', null, ['id'=>'image_store_id']) !!} 
                                <div class="padding5" id="remove-img" <?=!empty($category->image_logo->id) ? "" : "style=\"display: none\"" ?> ><button type="button" class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i> นำออก</button></div>
                                <div class="padding5"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-picture"></i> เลือกภาพ</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>     
    </div><!-- /.box -->
    
    
</div><!--/.col -->
<div class="col-sm-12">
    <div class="box-footer">   
        <div class="pull-right">
            <button type="submit" class="btn btn-info">บันทึก</button>
            <a href="{{ route('category.index') }}" class="btn btn-default load-form">ยกเลิก</a>
        </div>
    </div>                
</div>

{!! Form::close() !!}


<!----include image-gallery ---->
@include("partials.image-gallery-modal")
<!----/include image-gallery ---->



@section('stylesheet')
<!-- bootstrap-switch -->
<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
@endsection

@section('script')
<!-- tinymce -->
<script src="{{ URL::asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('plugins/tinymce/custom_admin_tinymce.js') }}"></script>
<!-- bootstrap-switch -->
<script src="{{ URL::asset('plugins/bootstrap-switch-master/dist/js/bootstrap-switch.min.js') }}"></script>
@endsection

@section('script-custom')
<script>
    $(function () {
        $("[name='active']").bootstrapSwitch();
    });
</script>
@endsection

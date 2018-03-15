<div class="row">

    <div class="col-md-8">

        @include("partials.alert-session")
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-fw fa-file-text"></i> ข้อมูลทั่วไปของสินค้า</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-horizontal">
                    <?php /* <div class="form-group">
                      <label for="p_code" class="col-sm-3 control-label required_field">รหัสสินค้า</label>
                      <div class="col-sm-9">
                      {!! Form::text('p_code', null, ['class' => 'form-control','id'=>'p_code', 'required'=>'true']) !!}
                      </div>
                      </div> */ ?>
                    <div class="form-group">
                        <label for="p_name" class="col-sm-3 control-label required_field">ชื่อสินค้า</label>
                        <div class="col-sm-9">
                            {!! Form::text('p_name', null, ['class' => 'form-control','id'=>'p_name', 'required'=>'true']) !!}                                   
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="type_product_id" class="col-sm-3 control-label required_field">ประเภทสินค้า</label>
                        <div class="col-sm-9">
                            {!! Form::select('category_id', $categorys, null, ['class' => 'form-control']) !!}                                 
                        </div>
                    </div>                            
                    <div class="form-group">
                        <label for="p_price" class=" col-sm-3 control-label required_field">ราคา</label>
                        <div class="col-sm-4">
                            {!! Form::text('p_price', null, ['class' => 'form-control','id'=>'p_price', 'required'=>'true']) !!}                                   
                        </div>                                    
                    </div>
                    <div class="form-group">
                        <label for="p_quantity" class=" col-sm-3 control-label required_field">จำนวน</label>
                        <div class="col-sm-4">
                            {!! Form::text('p_quantity', null, ['class' => 'form-control','id'=>'p_quantity', 'required'=>'true']) !!}                                   
                        </div>                                    
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-fw fa-tags"></i> ป้าย Tag</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-horizontal">                            
                    <div class="form-group">
                        <label for="p_tags" class="col-sm-3 control-label">ป้าย Tag</label>
                        <div class="col-sm-9">
                            {!! Form::text('p_tags', null, ['class' => 'form-control','id'=>'p_tags', 'required'=>'true', 'data-role'=>'tagsinput']) !!}                                   
                        </div>
                    </div>                             
                </div>
                <div class="col-sm-offset-3 col-sm-9 font13"><p>ให้ใส่คำ Keywords ที่เกี่ยวข้อง คั่นด้วย , (ลูกน้ำ)</p></div>
            </div>
            <!-- /.box-body -->
        </div>
        
        


    </div>

    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" ><i class="glyphicon glyphicon-eye-open"></i> การแสดงผลสินค้า</h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">                            
                        <label for="active" class="col-sm-6 control-label">สถานะ</label>
                        <div class="col-sm-6">
                            {!! Form::checkbox('p_active', 1, null, ['class'=>'jscheckbox', 'data-on-text'=>'แสดง','data-off-text'=>'ซ่อน'] ) !!} 
                        </div>
                    </div>
                </div> 

            </div>
        </div><!-- /.box -->

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" >สถานะของสินค้า</h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">                            
                        <label for="active" class="col-sm-6 control-label">สถานะการขาย</label>
                        <div class="col-sm-6">
                            {!! Form::select('p_sell_status', $sell_status_source, null, ['class' => 'form-control']) !!} 
                        </div>
                    </div>
                    <div class="form-group">                            
                        <label for="active" class="col-sm-6 control-label">เป็นสินค้าแนะนำ</label>
                        <div class="col-sm-6">
                            {!! Form::checkbox('p_recommend', 1, null, ['class'=>'jscheckbox', 'data-on-text'=>'ใช่','data-off-text'=>'ไม่ใช่']) !!} 
                        </div>
                    </div>
                    <div class="form-group">                            
                        <label for="active" class="col-sm-6 control-label">เป็นสินค้าขายดี</label>
                        <div class="col-sm-6">
                            {!! Form::checkbox('p_best_sell', 1,null, ['class'=>'jscheckbox', 'data-on-text'=>'ใช่','data-off-text'=>'ไม่ใช่']) !!} 
                        </div>
                    </div>
                    <div class="form-group">                            
                        <label for="active" class="col-sm-6 control-label">เป็นสินค้ามาใหม่</label>
                        <div class="col-sm-6">
                            {!! Form::checkbox('p_new', 1, null,['class'=>'jscheckbox', 'data-on-text'=>'ใช่', 'data-off-text'=>'ไม่ใช่']) !!} 
                        </div>
                    </div>
                </div> 

            </div>     
        </div><!-- /.box -->
    </div><!--/.col -->
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" ><i class="glyphicon glyphicon-eye-open"></i> ตัวเลือกสินค้า</h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">                    
                    <div class="form-group">                            
                        <label for="p_model" class="col-sm-3 control-label">ตัวเลือกแบบเลือกได้</label>
                        <div class="col-sm-9">
                            {!! Form::select('type_option', ['' => '--- ไม่ใช้ ---','1'=>'ตัวเลือก1 (เช่น สี)', '2' => 'ตัวเลือก1 + ตัวเลือก2 (เช่น สี + ขนาด)'], null, ['class' => 'form-control','id'=>'type_option']) !!} 
                            
                       </div>
                    </div>                    
                </div> 
                <div class="col-sm-3"> </div>
                <div class="col-sm-9" style="padding-left: 6px;">
                    <div class=" table-responsive no-padding" id="res_table_option">                        
                        
                    </div>
                </div>
            </div>
        </div><!-- /.box -->

                                                                        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" ><i class="glyphicon glyphicon-eye-open"></i> รายละเอียดอื่นๆ</h3>
            </div>
            <div class="box-body">                        
                <div class="form-group">                            
                    <label for="p_detail" class="control-label">รายละเอียดสินค้า</label>
                    {!! Form::textarea('p_detail', null, ['class'=>'tinymce','id'=>'p_detail']) !!}                            
                </div>
            </div>
        </div><!-- /.box -->

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title" ><i class="fa fa-line-chart"></i> ตั้งค่า SEO ของสินค้า</h3>
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
                <div class="col-sm-offset-2 col-sm-10 font13"><p>หากเว้นว่างไว้ ระบบจะกรอกข้อมูลจากรายละเอียดของหมวดหมู่ให้อัตโนมัติ</p></div>
            </div>
        </div><!-- /.box -->
    </div>  

</div>

<button type="submit" class="hidden" ></button>



@section('stylesheet')
<link href="{{ URL::asset('plugins/dropzone/css/dropzone.css') }}" rel="stylesheet"/>
<!-- bootstrap-switch -->
<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
<!--tagsinput -->
<link href="{{ URL::asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('script')
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- dropzone -->
<script src="{{ URL::asset('plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('dist/js/form-dropzone.js') }}"></script>
<!-- CK Editor -->
<!--<script src="{{ URL::asset('plugins/ckeditor/ckeditor.js') }}"></script>-->
<!-- tinymce -->
<script src="{{ URL::asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('plugins/tinymce/custom_admin_tinymce.js') }}"></script>
<!-- bootstrap-switch -->
<script src="{{ URL::asset('plugins/bootstrap-switch-master/dist/js/bootstrap-switch.min.js') }}"></script>
<!--tagsinput -->
<script src="{{ URL::asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
@endsection



@section('script-custom')
<script>
var product = null;
var product_attr = null;
jQuery(document).ready(function () {
     $('.jsiCheck').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue'
    });
    <?php if(!empty($product->id)){ ?>
        set_form_edit(<?=$product->id?>);
    <?php } ?>
    FormDropzone.init();
    setval();
    $(".jscheckbox").bootstrapSwitch();

    
  
  
  
    $('#tab_2 .nav-tabs-custom li a').each(function() {
        load_tab($(this).attr('album'));
        console.log($(this).attr('album'));
        return false;
    });
    
    $(".parent-image").sortable({
//        handle: '.image_use',
        update: function(event, ui) {
            var result = jQuery(this).sortable('toArray');
            console.log(result);
            //flag_update = true; // true, category position is changed
            //saveposition(result.join(","));
        }
    });
    update_count_img();
});

    var attr_image = new Array();

    function set_form_edit(id){   

        $('.dz-preview.image_use').each(function() {           
            attr_image.push({            
                'id' : $(this).find('.hidden_id').val(),
                'image_store_id' : $(this).find('.hidden_image_store_id').val(),
            });
        });

        $.ajax({
            url: "{{ url('product/get_stock') }}/"+id,
            dataType: "json",
            success: function (res) {  
                product = res.product;
                product_attr = res.product_attr;
//                console.log(product);
//                console.log(product_attr);
                let res_table_option = $('#res_table_option');
                res_table_option.html(htmlOption(product.type_option, product.name_option1, product.name_option2));
                res_table_option.find('tbody').empty();
                for (i = 0; i < product_attr.length; i++) { 
                    res_table_option.find('tbody').append(option_row(product.type_option,product_attr[i]));   
                }
            }
        });
    }

    function setval(){
        $('#album_id_hidden').val($('#album_id').val());
    }

    $('.tabbable a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    //  e.target // newly activated tab
    //  e.relatedTarget // previous active tab
    //  console.log(e.target);
        $('.overlay').show();
        var id_album = $(this).attr('album');
        load_tab(id_album);
    });

    function load_tab(id_album){
        $('#to-'+id_album).empty();
        $.ajax({
            url: "{{ url('admin/image/load_album') }}/"+id_album,
    //        method: 'post',
    //        data: {
    //            album_id: id_album,
    //            _token: $('form#my-dropzone input[name="_token"]').val()
    //        },
            success: function (res) {            
                $('#to-'+id_album).html(res);
                $('.overlay').hide();
                check_image();
            }
        });
    }

    function check_image(){
       var selectedItems = new Array(); 
       $(".image_use").each(function() {
           selectedItems.push($(this).attr('id'));
       });
    //   console.log(selectedItems);
       $(".imagezone .dz-preview").each(function() {
           tempid = $(this).attr('id').replace("image_id_", "");
    //       console.log(tempid);
           if(selectedItems.indexOf(tempid) > -1){
               $(this).addClass('select');
           }
       });


    }

    $('body').on('click', '.paginate_image a', function(event) {
        $('.overlay').show();
    //    console.log(event.target);
    //    return false;
        var id_album = $(this).parents().find('.paginate_image').attr('for');
    //    console.log(id_album);
    //    console.log(event.target.href);
        $.ajax({
            url: event.target.href,
            success: function (res) {            
                $('#to-'+id_album).html(res);
                $('.overlay').hide();
                check_image();
            }
        });
        return false;
    });

    $("#add-new-album").click(function (event) {
        event.preventDefault();
        var newAlbum = $("#album_name");
        var inputAlbum = newAlbum.closest('.form-group');
        if($("#album_name").val() == ""){
            inputAlbum.next('.text-danger').remove();
            inputAlbum.addClass('has-error');
            return false;
        }
        $.ajax({
            url: "{{ url("admin/image/save_album") }}",
            method: 'post',
            data: {
                album_name: $("#album_name").val(),
                _token: $('form#my-dropzone input[name="_token"]').val()
            },
            success: function (album) {
    //            console.log(album);
                if (album.id != null) {
                    inputAlbum.removeClass('has-error');
    //                inputAlbum.next('.text-danger').remove();

                    var newOption = $('<option></option>')
                            .attr('value', album.id)
                            .attr('selected', true)
                            .text(album.album_name);

                    $("select[name=album_id]")
                            .append(newOption);

                    newAlbum.val("");
                }
            },
            error: function (xhr) {
    //            console.log(xhr);
                var errors = xhr.responseJSON;
                var error = errors.album_name[0];
                if (error) {
                    inputAlbum.next('.text-danger').remove();
                    inputAlbum
                            .addClass('has-error');
    //                        .after('<span class="text-danger">' + error + '</span>');
                }
            }
        });
    });

    
    var key_img = 99;
    function append_image(path){
        temp = path.split("/");
        temp_id = temp[temp.length - 2];
        var selectedItems = new Array(); 
        $(".image_use").each(function() {
            selectedItems.push($(this).attr('id'));
        });  
        var id_val = "";
        //get  id เดิมของมัน
        attr_image_length = attr_image.length;        
        for (var i = 0; i < attr_image_length; i++) {                
            if(attr_image[i].image_store_id === temp_id){
                id_val = attr_image[i].id;
                break;
            }
        }
        
       if(selectedItems.indexOf(temp_id) === -1){
            $('.image_zone').append('<div class="dz-preview image_use" id="'+temp_id+'">'+
                            '<div class="dz-details">'+
//                                '<div class="dz-filename"><span data-dz-name="">318184.jpg</span></div>'+
//                               '<div class="dz-size" data-dz-size="">35.8 KB</div>'+
                                '<img data-dz-thumbnail="" alt="" data-src="" src="'+path+'" >'+
                            '</div>'+
                            '<div class="select_frame"></div>'+
                            '<input type="hidden" name="product_image['+key_img+'][id]" form="frmproduct" class="hidden_id" value="'+id_val+'" >'+
                            '<input type="hidden" name="product_image['+key_img+'][product_id]" form="frmproduct" value="<?=!empty($product->id) ? $product->id : ""?>" >'+
                            '<input type="hidden" name="product_image['+key_img+'][image_store_id]" form="frmproduct" class="hidden_image_store_id" value="'+temp_id+'" >'+
                            '<button type="button" class="closeImg"><span>x</span></button>'+
                        '</div>');
                key_img++;
        }
        update_count_img();
    }
    
    $('body').on('click', '.closeImg', function(event) {   
        $(this).closest('.dz-preview').remove();
        let image_id = $(this).closest('.dz-preview').attr('id');
        $('.imagezone #image_id_'+image_id).removeClass('select');
        update_count_img();
    });
    
    function remove_image(path){
        temp = path.split("/");
        $('#'+temp[temp.length - 2]).remove();
        update_count_img();
    }
    
    function update_count_img(){
        $('.txt_num_img').text($('.image_use').length);
    }
    
    $('#btnsave').click(function(){
        $('#frmproduct').submit();
    });
    
    $('#frmproduct').submit(function(){
        
    });
    
    $('#type_option').change(function(){
        let res_table_option = $('#res_table_option');
        
        if($(this).val() === '1'){            
            res_table_option.html(htmlOption(1));            
        }else if($(this).val() === '2'){
            res_table_option.html(htmlOption(2));            
        }else{
            res_table_option.empty();
        }
    });
    
    
    
    function addrow(event){        
        
        if($('#type_option').val() === '1'){
            event.closest('table').find('tbody').append(option_row(1));            
        }else if($('#type_option').val() === '2'){
            event.closest('table').find('tbody').append(option_row(2));
        }        
    }
    function delrow(event){     
        count_row = event.closest('tbody').find('tr').length;
        if(count_row > 1){
            event.closest('tr').remove();  
        }
    }
    
    
    
    function htmlOption(main_option, name_option1 = "", name_option2 = "") {
        if(main_option === 1){
            return '<table class="table table-bordered table-option-grey" style=" width: 700px">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th width="10%"><button type="button" class="btn btn-small btn-success" onclick="addrow($(this))" ><i class="fa fa-fw fa-plus"></i></button></th>'+
                                    '<th width="60%"><input type="text" class="form-control" placeholder="ชื่อตัวเลือก (เช่น สี)" name="name_option1" required="true" value="'+name_option1+'"></th>'+
                                    '<th width="15%">ราคา</th> '+    
                                    '<th width="15%">จำนวน</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody> '+                                   
                               option_row(1) +
                            '</tbody>'+
                        '</table>';
        }
        
        if(main_option === 2){
            return '<table class="table table-bordered table-option-grey" style=" width: 700px">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th width="10%"><button type="button" class="btn btn-small btn-success" onclick="addrow($(this))" ><i class="fa fa-fw fa-plus"></i></button></th>'+
                                    '<th width="30%"><input type="text" class="form-control" placeholder="ชื่อตัวเลือก (เช่น สี)" name="name_option1"  required="true" value="'+name_option1+'"></th>'+
                                    '<th width="30%"><input type="text" class="form-control" placeholder="ชื่อตัวเลือก (เช่น ขนาด)" name="name_option2"  required="true" value="'+name_option2+'"></th>'+
                                    '<th width="15%">ราคา</th>'+    
                                    '<th width="15%">จำนวน</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+                                    
                                option_row(2) +
                            '</tbody>'+
                        '</table>';    
        }
    }
    
    var key_attribute = 99;
    function option_row(main_option,data = {'id':'', 'product_id':'', 'option1':'', 'option2':'', 'p_price':'', 'p_quantity':'',}) {
        key_attribute++;
        if(main_option === 1){
            return '<tr>'+
                        '<td><button type="button" class="btn btn-small btn-danger" onclick="delrow($(this))" ><i class="fa fa-fw fa-trash-o"></i></button></td>'+
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][option1]" placeholder="ค่าที่เลือก (เช่น สีแดง)" required="true" value="'+data.option1+'"></td>'+
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][p_price]" placeholder="ราคา" required="true" value="'+data.p_price+'"></td>'+ 
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][p_quantity]" placeholder="จำนวน" required="true" value="'+data.p_quantity+'"></td>'+
                        '<input type="hidden" name="product_attribute['+key_attribute+'][id]" class="hidden_id" value="'+data.id+'">'+
                        '<input type="hidden" name="product_attribute['+key_attribute+'][product_id]"  value="'+data.product_id+'">'+
                    '</tr>'
        }
        
        if(main_option === 2){
            return '<tr>'+
                        '<td><button type="button" class="btn btn-small btn-danger" onclick="delrow($(this))" ><i class="fa fa-fw fa-trash-o"></i></button></td>'+
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][option1]" placeholder="ค่าที่เลือก (เช่น สีแดง)" required="true" value="'+data.option1+'"></td>'+
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][option2]" placeholder="ค่าที่เลือก (เช่น M)" required="true" value="'+data.option2+'"></td>'+
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][p_price]" placeholder="ราคา" required="true" value="'+data.p_price+'"></td>'+ 
                        '<td><input type="text" class="form-control" name="product_attribute['+key_attribute+'][p_quantity]" placeholder="จำนวน" required="true" value="'+data.p_quantity+'"></td>'+
                        '<input type="hidden" name="product_attribute['+key_attribute+'][id]" class="hidden_id" value="'+data.id+'">'+
                        '<input type="hidden" name="product_attribute['+key_attribute+'][product_id]"  value="'+data.product_id+'">'+
                    '</tr>'
        }
        
    }
    
    
    
    
    
     //$("#p_model option[value='"+sp2[sp2_index]+"']").prop('selected', true);

</script>   
@endsection
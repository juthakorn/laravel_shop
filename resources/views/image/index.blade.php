@extends('layouts.admin')
@section('title', 'คลังรูปภาพ')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            คลังรูปภาพ
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">คลังรูปภาพ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            <div class="col-md-12">
                <div class="box box-info box-footer" style="border-top-width: 3px">   
                    <div class="pull-right">
                        <button type="submit" class="btn btn-info" form="frmproduct" >บันทึก</button>
                        <button type="reset" class="btn btn-default" form="frmproduct">ยกเลิก</button>
                    </div>
                </div>                
            </div>   

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="glyphicon glyphicon-picture"></i> อัพโหลดรูปภาพ</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                               
                        <div class="form-inline form-album" style="padding:5px 23px;" >
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
                        <form action="{{ url('admin/image/saveimg') }}" class="dropzone" id="my-dropzone" style="margin-top: 10px;margin-bottom : 10px;">{{ csrf_field() }}
                            <input type="hidden" name="album_id" id="album_id_hidden" >
                        </form>
                    </div>
                    <!-- /.box-body -->
                    
                </div>

            </div>

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="glyphicon glyphicon-picture"></i> รูปภาพ</h3>
                    </div>
                    <div class="box-body">
                        <div class="tab_2 nav-tabs-custom tabbable" style="margin: 10px; border: 1px solid #ebebeb;">
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
                    <div class="overlay" style="display: none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    
                </div>            
            </div>
            

           
        </div>

        
    </section>    
</div><!-- /.content -->

@endsection


@section('stylesheet')
<link href="{{ URL::asset('plugins/dropzone/css/dropzone.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('plugins/image-lightbox/css/imagelightbox.css') }}" rel="stylesheet"/>
@endsection

@section('script')
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- dropzone -->
<script src="{{ URL::asset('plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('dist/js/form-dropzone-2.js') }}"></script>
<script src="{{ URL::asset('plugins/image-lightbox/js/imagelightbox.js') }}"></script>
<script src="{{ URL::asset('plugins/image-lightbox/js/imagelightbox.custom.js') }}"></script>

@endsection

@section('script-custom')
<script>

var product = null;
var product_attr = null;
jQuery(document).ready(function () {   
  
    FormDropzone.init();
    setval();  
  
    $('.tab_2.nav-tabs-custom li a').each(function() {
        load_tab($(this).attr('album'));
        return false;
    });
    
});

    function setval(){
        $('#album_id_hidden').val($('#album_id').val());
    }

    $('.tabbable a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        load_tab($(this).attr('album'));
    });

    function load_tab(id_album){
        $('.overlay').show();
        $('#to-'+id_album).html('<div class="row"><div  class="imagezone image_from_db dz-clickable dz-started"></div></div>');
        $.ajax({
            url: "{{ url('admin/image/load_album_image') }}/"+id_album,
            success: function (res) {            
                $('#to-'+id_album).html(res);
                $('.overlay').hide(); 
                var selectorG = '#to-'+ id_album + ' a[data-imagelightbox="gallery"]';
                var instanceG = $( selectorG ).imageLightbox(
                    {
                        onStart:        function(){ arrowsOn( instanceG, selectorG ); overlayOn(); closeButtonOn(selectorG);},
                        onEnd:          function(){ arrowsOff();  overlayOff(); closeButtonOff(); },
                        onLoadStart:    function(){ activityIndicatorOn(); },
                        onLoadEnd:      function(){ $( '.imagelightbox-arrow' ).css( 'display', 'block' ); activityIndicatorOff(); }
                         
                    });               
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
            }
        });
    });

function RemoveImg(id){
    console.log(id);
    $.ajax({
     url: "{{ url("admin/image") }}/" + id,
        method: "POST",
        dataType:'json',
        data: {'data':id,'_method': 'DELETE','_token':$('form#my-dropzone input[name="_token"]').val() },
        success: function(response) {

        }
    });
}
</script>
@endsection
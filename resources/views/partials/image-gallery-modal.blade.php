<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">



                <div class="nav-tabs-custom image-manger">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">อัพโหลด</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">เลือกจากคลังรูปภาพ</a></li> 
                    </ul>
                    <div class="tab-content box-overlay">
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
                        <div class="overlay" style="display: none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <!-- /.tab-content -->

                </div>
                <!-- nav-tabs-custom -->




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="select_img">บันทึก</button>
            </div>
        </div>
    </div>
</div>


@section('stylesheet2')
<link href="{{ URL::asset('plugins/dropzone/css/dropzone.css') }}" rel="stylesheet"/>
@endsection

@section('script2')
<script src="{{ URL::asset('plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('dist/js/form-dropzone.js') }}"></script>
@endsection


@section('script-custom3')
<script>
jQuery(document).ready(function () {

    FormDropzone.init();
    setval();
   
    $('#tab_2 .nav-tabs-custom li a').each(function() {
        load_tab($(this).attr('album'));
        console.log($(this).attr('album'));
        return false;
    });
    
});
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
         
        }
    });
}


$("#add-new-album").click(function (event) {
    event.preventDefault();
    var newAlbum = $("#album_name");
    var inputAlbum = newAlbum.closest('.form-group');

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

var image_store_id = "";
var image_path = "";
function append_image(path){
    
    temp = path.split("/");
    image_store_id = temp[temp.length - 2];    
    image_path = path.replace("150px", "");
//    $(".imagezone .dz-preview,.dropzone .dz-preview").removeClass('select');
    $(".imagezone .dz-preview.select").each(function() {
       tempid = $(this).attr('id').replace("image_id_", "");
        console.log(tempid);
       if(tempid !== image_store_id){
           $(this).removeClass('select');
       }       
    });
    $(".dropzone .dz-preview.select").each(function() {
       tempid = $(this).attr('id');
       tempid = tempid.split("/");
        console.log(tempid[0]);
       if(tempid[0] !== image_store_id){
           $(this).removeClass('select');
       }       
    });
    return false;
}

function remove_image(path){
    return false;
}

function check_image(){
    return false;
}

$('#select_img').click(function(){
    if(image_path !== ""){
        $('#logo').attr('src',image_path);
        $('#image_store_id').val(image_store_id);        
        $('#myModal').modal('hide');
    }
    
});
$('#myModal').on('hidden.bs.modal', function (e) {           
    if($('#image_store_id').val() !== '' && $('#image_store_id').val() !== '0'){
        $('#remove-img').show();
    }  
});
var no_image = "{{ url('image/nopicture.png') }}";
$('#remove-img').click(function(){
    $('#logo').attr('src',no_image);
    $('#image_store_id').val('');
    $(this).hide();
});
</script>
@endsection
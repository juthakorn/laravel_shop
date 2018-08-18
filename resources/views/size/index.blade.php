@extends('layouts.admin')
@section('title', 'จัดการรายละเอียดไซส์')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการรายละเอียดไซส์
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">สินค้า</a></li>
            <li class="active">รายละเอียดไซส์</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
             <div class="row">
         
            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="box-title">เพิ่มรายละเอียดไซส์</h3>
                    </div>
                    <div id="body-form" >                    
                    <!-- Horizontal Form -->
                    @include("size.form")  
                    
                    </div><!-- /#body-form -->
                    <div class="overlay" style="display: none">
                       <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div><!-- /.box -->
            </div><!--/.col -->
            
        </div>
        
        <div class="row">        
            <div class="col-md-12">
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ข้อมูลรายละเอียดไซส์</h3>
                    </div>                  

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="">ชื่อรายละเอียดไซส์</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sizes as $key => $value) { ?>
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('size.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขรายละเอียดไซส์"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="{{ route('size.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->name }}"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                <tbody>    
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div><!-- /.row -->
    </section>    
</div><!-- /.content -->

    @include('partials.confirm-modal')
@endsection


@section('script')
<!-- tinymce -->
<script src="{{ URL::asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('plugins/tinymce/custom_admin_tinymce.js') }}"></script>
@endsection

@section('script-custom')
<script>
    $('body').on('click', '.load-form', function(event) {
        event.preventDefault();
        $('.overlay').show();
        $('body,html').animate({
                    scrollTop: 0
                }, 300);
        var me = $(this),
            url = me.attr('href'),
            title = me.attr('title');            
            title = title !== undefined ? title : "เพิ่มรายละเอียดไซส์"
            
        $('#box-title').text(title);
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(response) {
                $('#body-form').html(response);
                $('.overlay').hide();
                $('.btn-submit').text(me.hasClass('edit') ? 'Update' : 'Create New');
                tinymce.init(editor_config);
            }
        });

    });
    
    $('body').on('click', '.show-confirm-modal', function(event) {
        event.preventDefault();

        var me = $(this),
            title = me.attr('data-title'),
            action = me.attr('href');

        $('#confirm-body form').attr('action', action);
        $('#confirm-body p').html("คุณต้องการลบรายละเอียดไซส์ : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
    
    $('#confirm-remove-btn').click(function(event) {
        event.preventDefault();
        $('#confirm-body form').submit();           
    });
    $(function () {
        $('.datepicker').datepicker({
          autoclose: true
        }); 
         //iCheck for checkbox and radio inputs
        $('input[type="checkbox"], input[type="radio"]').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue'
        });
        $("#datatable").DataTable();
    
    });
</script>
@endsection
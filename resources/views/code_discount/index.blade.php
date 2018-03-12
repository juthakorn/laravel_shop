@extends('layouts.admin')
@section('title', 'จัดการรหัสส่วนลด')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการรหัสส่วนลด
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">โปรโมชั่น</a></li>
            <li class="active">รหัสส่วนลด</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
             <div class="row">
         
            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="box-title">เพิ่มรหัสส่วนลด</h3>
                    </div>
                    <div id="body-form" >                    
                    <!-- Horizontal Form -->
                    @include("code_discount.form")  
                    
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
                        <h3 class="box-title">ข้อมูลรหัสส่วนลด</h3>
                    </div>                  

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th width="15%">รหัสส่วนลด</th>
                                        <th width="15%">ส่วนลด (เป็น %)</th>
                                        <th width="15%">วันที่เริ่ม</th>
                                        <th width="15%">วันที่สิ้นสุด</th>
                                        <th width="10%">สถานะ</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($code_discounts as $key => $value) { ?>
                                    <tr>
                                        <td>{{ $value->code }}</td>
                                        <td>{{ $value->discount }}</td>
                                        <td>{{ $value->start }}</td>
                                        <td>{{ $value->end }}</td>
                                        <td class="text-center"><i class="fa fa-fw {{ $value->status ? "fa-eye" : "fa-eye-slash" }} fa-lg"></i></td>
                                        <td class="text-center">
                                            <a href="{{ route('code_discount.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขรหัสส่วนลด"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a href="{{ route('code_discount.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->code }}"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                <tbody>    
                            </table>
                        </div>
                        <div class=" pull-right">
                            <nav>
                             {!! $code_discounts->appends( Request::query() )->render() !!}
                            </nav>
                        </div>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div><!-- /.row -->
    </section>    
</div><!-- /.content -->

    @include('partials.confirm-modal')
@endsection

@section('stylesheet')
<!-- bootstrap-switch -->
<link rel="stylesheet" href="{{ URL::asset('plugins/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
@endsection

@section('script')
<!-- bootstrap-switch -->
<script src="{{ URL::asset('plugins/bootstrap-switch-master/dist/js/bootstrap-switch.min.js') }}"></script>
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
            title = title !== undefined ? title : "เพิ่มรหัสส่วนลด"
            
        $('#box-title').text(title);
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(response) {
                $('#body-form').html(response);
                $('.overlay').hide();
                $('.btn-submit').text(me.hasClass('edit') ? 'Update' : 'Create New');
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                  });          
                  $('input[type="checkbox"], input[type="radio"]').bootstrapSwitch();
            }
        });

//        $('#todolist-modal').modal('show');
    });
    
    $('body').on('click', '.show-confirm-modal', function(event) {
        event.preventDefault();

        var me = $(this),
            title = me.attr('data-title'),
            action = me.attr('href');

        $('#confirm-body form').attr('action', action);
        $('#confirm-body p').html("คุณต้องการลบรหัสส่วนลด : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
    
    $('#confirm-remove-btn').click(function(event) {
        event.preventDefault();
        $('#confirm-body form').submit();           
    });
    $(function () {
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        });          
        $('input[type="checkbox"], input[type="radio"]').bootstrapSwitch();   
    });
    function makecode() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 5; i++)
          text += possible.charAt(Math.floor(Math.random() * possible.length));
        
        $('#code').val(text);
    }
    
</script>
@endsection
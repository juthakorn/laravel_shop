@extends('layouts.admin')
@section('title', 'จัดการประเภทสินค้า')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการประเภทสินค้า
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">สินค้า</a></li>
            <li class="active">เพิ่มประเภทสินค้า</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">ประเภทสินค้า</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50px">Sort</th>
                                    <th class="text-center">ประเภท</th>
                                    <th class="text-center">สถานะ</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">  
                                <?php foreach ($type_products as $key => $value) { ?> 
                                <tr class="text-center" id="{{ $value->id }}">
                                    <td><i class="fa fa-fw fa-bars fa-lg"></i></td>
                                    <td >{{ $value->type_name }}</td>
                                    <td ><i class="fa fa-fw {{ $value->active ? "fa-eye" : "fa-eye-slash" }} fa-lg"></i></td>
                                    <td >
                                        <a href="{{ route('type_product.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขประเภทสินค้า"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ route('type_product.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->type_name }}"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    
                  </div>
                
                
               
              
            </div>

        </div>


    </section>    
</div><!-- /.content -->
@include('partials.confirm-modal')
@endsection
@section('stylesheet')
<!--<link rel="stylesheet" href="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.css') }}">-->
@endsection

@section('script')
<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection

@section('script-custom')
<script>
    $(function () {
//        $("#sortable").sortable();
//        $("#sortable").disableSelection();
//        $('.tbody').sortable();
         $( ".tbody" ).sortable({
            update: function(event, ui) {
                var result = jQuery(this).sortable('toArray');
                flag_update = true; // true, category position is changed
                saveposition(result.join(","));
            }
        });
    });
    function saveposition(data){
        $.ajax({
            url: "{{ route('type_product.position') }}",
            method: "POST",
            data: {'data':data,'_token':'{{ csrf_token() }}' },
            success: function(response) {

            }
        });
    }
    
    $('#confirm-remove-btn').click(function(event) {
        event.preventDefault();
        $('#confirm-body form').submit();           
    });
    $('.show-confirm-modal').click(function(event) {
        event.preventDefault();

        var me = $(this),
            title = me.attr('data-title'),
            action = me.attr('href');

        $('#confirm-body form').attr('action', action);
        $('#confirm-body p').html("คุณต้องการลบประเภทสินค้า : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
</script>
@endsection
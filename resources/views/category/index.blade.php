@extends('layouts.admin')
@section('title', 'จัดการหมวดหมู่')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการหมวดหมู่
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">หมวดหมู่</a></li>
            <li class="active">เพิ่มหมวดหมู่</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            
            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div style="margin-bottom: 10px;">
                    <a href="{{ url('/admin/category/create') }}" class="btn btn-primary" >เพิ่มหมวดหมู่สินค้า</a>
                    <a href="{{ url('/admin/category/position') }}" class="btn btn-success" style=" margin-left: 10px;">เรียงหมวดหมู่สินค้า</a>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">หมวดหมู่</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <!--<th style="width: 50px">Sort</th>-->
                                    <th class="text-center">หมวดหมู่หลัก</th>
                                    <th class="text-center">ชื่อหมวดหมู่</th>
                                    <th class="text-center">สถานะ</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">  
                                <?php foreach ($categorys as $key => $value) { ?> 
                                <tr class="text-center" id="{{ $value->id }}">
<!--                                    <td><i class="fa fa-fw fa-bars fa-lg"></i></td>-->
                                    <td ><?= $value->parent_id == 0 ? "<span style=\"color:#dc241f;\">หมวดหมู่หลัก</span>" : $value->MainCategory->cat_name ?></td>
                                    <td >{{ $value->cat_name }}</td>
                                    <td ><i class="fa fa-fw {{ $value->active ? "fa-eye" : "fa-eye-slash" }} fa-lg"></i></td>
                                    <td >
                                        <a href="{{ route('category.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขหมวดหมู่"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ route('category.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->cat_name }}"><i class="glyphicon glyphicon-remove"></i></a>
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

@endsection

@section('script')

@endsection

@section('script-custom')
<script>
    
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
        $('#confirm-body p').html("คุณต้องการลบหมวดหมู่ : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
</script>
@endsection
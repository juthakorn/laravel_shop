@extends('layouts.admin')
@section('title', 'จัดการบทความ')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการบทความ
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">บทความ</a></li>
            <li class="active">เพิ่มบทความ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">บทความ</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class=" table-responsive" >
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 50px">Sort</th>
                                    <th class="text-center">บทความ</th>
                                    <th class="text-center">สถานะ</th>
                                    <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">  
                                <?php foreach ($blogs as $key => $value) { ?> 
                                <tr class="text-center" id="{{ $value->id }}">
                                    <td><i class="fa fa-fw fa-bars fa-lg"></i></td>
                                    <td >{{ $value->blog_name }}</td>
                                    <td ><i class="fa fa-fw {{ $value->active ? "fa-eye" : "fa-eye-slash" }} fa-lg"></i></td>
                                    <td >
                                        <a href="{{ route('blog.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขบทความ"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ route('blog.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->blog_name }}"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>                    
                    <div class=" pull-right">
                        <nav>
                         {!! $blogs->appends( Request::query() )->render() !!}
                        </nav>
                    </div>
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
<script src="{{ url('plugins/jquery-ui/jquery-ui.min.js') }} "></script>
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
        $('#confirm-body p').html("คุณต้องการลบบทความน้ : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
</script>
@endsection
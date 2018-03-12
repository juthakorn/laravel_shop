@extends('layouts.admin')
@section('title', 'จัดการหมวดหมู่')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการหมวดหมู่
            
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
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">หมวดหมู่</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div><small id="output"></small></div>
                        <div id="message" class="callout callout-success alert-dismissable" style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <span></span>    
                        </div>

                        
                       <div class="dd" id="nestable">
                            <ol class="dd-list">
                                @foreach ($categorys as $key => $value)
                                    <li class="dd-item dd3-item" data-id="{{ $value->id }}">
                                        <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">{{ $value->cat_name }}</div>
                                    
                                   
                                    <?php 
                                    $subcat = $value->SubCategory;
                                    if(!$subcat->isEmpty()){ ?>
                                        <ol class="dd-list">
                                        <?php foreach ($subcat as $keysub => $valuesub) { ?>
                                           <li class="dd-item dd3-item" data-id="{{ $valuesub->id }}">
                                                <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">{{ $valuesub->cat_name }}</div>
                                            </li> 
                                        <?php } ?>
                                        </ol>
                                    <?php } ?>
                                    </li>    
                                @endforeach
                            </ol>
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


@section('script')
<script src="{{ URL::asset('plugins/nestable/jquery.nestable.js') }}"></script>
@endsection
@section('stylesheet')
<link rel="stylesheet" href="{{ URL::asset('plugins/nestable/nestable.css') }} ">
@endsection
@section('script-custom')
<script>
    $(document).ready(function()
    {

        var saveposition = function(e)
        {
            $('#message').show().find('span').text('กำลังบันทึก...');
            var list   = e.length ? e : $(e.target);
            $.ajax({
                method: "POST",
                url: "{{ route('category.position') }}",
                data: {
                    'list': list.nestable('serialize'), '_token':'{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#message').show().find('span').text('บันทึกสำเร็จ');
                }
            }).fail(function(jqXHR, textStatus, errorThrown){
                alert("Unable to save new list order: " + errorThrown);
            });
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            maxDepth :2
        })
        .on('change', saveposition);
        

    });
</script>
@endsection
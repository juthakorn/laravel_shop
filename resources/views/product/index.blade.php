@extends('layouts.admin')
@section('title', 'จัดการสินค้า')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tags"></i>
            Product management
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">สินค้า</a></li>
            <li class="active">จัดการสินค้า</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                
                @include("partials.alert-session")
                <div style="margin-bottom: 10px;">
                    <a href="{{ url('/admin/product/create') }}" class="btn btn-primary" >เพิ่มสินค้า</a>
                </div>
                <div class="box box-info">
<!--                    <div class="box-header with-border">
                      <h3 class="box-title">Product management</h3>
                    </div>-->
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                        <div class=" table-responsive" >
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center-th">
                                        <th width="15%">รูปภาพ</th>
                                        <th width="30%">ชื่อสินค้า</th>
                                        <th width="10%">ราคา</th>  
                                        <th width="15%">สถานะ</th>
                                        <th width="15%">แสดง</th>
                                        <th width="15%">จัดการ</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>   
                                    @if(!$products->isEmpty())
                                        @foreach($products as $key => $value)
                                        <tr class="text-center">
                                            <td>
                                                <?php 
                                                $arrimg = $value->image_stores()->orderBy('product_images.position', "asc")->take(1)->get()->toArray();
                                    
                                                if(!empty($arrimg)){?>
                                                
                                                    <img src="<?= ImgProduct($arrimg[0]['id'], $arrimg[0]['new_name150'])?>" style="height:50px;width: auto;">
                                                
                                                <?php }else{ ?>
                                                    <img src="/image/nopicture.png" style="height:50px;width: auto;"/>
                                                <?php }                                                  
//                                                foreach ($value->image_stores as $key_img => $value_img) {
//                                                    echo $value_img->new_name150;
//                                                }
                                                ?>
                                                
                                            </td>
                                            <td class="text-left" style="word-wrap: break-word;">{{ $value->p_name }}</td>
                                            <td>{{ $value->p_price }}</td>
                                            <td>{{ trans('common.p_sell_status_'.$value->p_sell_status) }}</td>
                                            <td><i class="fa fa-fw {{ $value->p_active ? "fa-eye" : "fa-eye-slash" }} fa-lg"></i></td>
                                            <td>
                                                <a href="{{ route('product.edit', $value->id) }}" class="btn btn-default edit load-form btn-circle" title="แก้ไขสินค้า"><i class="glyphicon glyphicon-edit"></i></a>
                                                <a href="{{ route('product.destroy', $value->id) }}" class="btn btn-danger show-confirm-modal btn-circle" data-title="{{ $value->p_name }}"><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>
                                        </tr>                                  
                                        @endforeach   
                                    @else
                                        <tr class="text-center">
                                            <td colspan="5" >Empty Dataggg</td>
                                        </tr> 
                                    @endif    
                                </tbody>
                            </table>
                        </div>
                        <div class=" pull-right">
                            <nav>
                             {!! $products->appends( Request::query() )->render() !!}
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
<!--<script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>-->
@endsection

@section('script-custom')
<script>
    $(function () {
//        $("#sortable").sortable();
//        $("#sortable").disableSelection();
//        $('.tbody').sortable();
//        $( ".tbody" ).sortable({
//            update: function(event, ui) {
//                var result = jQuery(this).sortable('toArray');
//                flag_update = true; // true, category position is changed
//                saveposition(result.join(","));
//            }
//        });
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
        $('#confirm-body p').html("คุณต้องการลบสินค้า : <strong>" + title + "</strong>");
        $('#confirm-modal').modal('show');
    });
</script>
@endsection
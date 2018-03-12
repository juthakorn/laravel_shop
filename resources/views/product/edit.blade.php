@extends('layouts.admin')
@section('title', 'แก้ไขสินค้า')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            แก้ไขสินค้า
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">สินค้า</a></li>
            <li class="active">แก้ไขสินค้า</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">               
        {!! Form::model($product, ['route' => ['product.update', $product->id], 'method' => 'PATCH', 'files' => true, 'id'=>'frmproduct']) !!}
                
            @include("product.form")
    
        {!! Form::close() !!}
            
        @include("product.form_image")     
    </section>    
</div><!-- /.content -->

@endsection

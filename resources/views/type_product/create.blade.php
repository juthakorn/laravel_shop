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
           
            @include("type_product.form")
    
           
        </div>

        
    </section>    
</div><!-- /.content -->

@endsection
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
            <li class="active">แก้ไขหมวดหมู่</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            @include("category.form")    
           
        </div>

        
    </section>    
</div><!-- /.content -->

@endsection
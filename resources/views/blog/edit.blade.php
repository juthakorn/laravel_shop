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
            <li class="active">แก้ไขบทความ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            
            @include("blog.form")    
           
        </div>

        
    </section>    
</div><!-- /.content -->

@endsection
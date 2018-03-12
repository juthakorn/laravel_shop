@extends('layouts.admin')
@section('title', 'จัดการข้อมูลร้านค้า')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            จัดการข้อมูลร้านค้า
            <!--<small>Preview</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>            
            <li class="active">ข้อมูลร้านค้า</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
             <div class="row">
         
            <div class="col-md-12">
                
                @include("partials.alert-session")
                
                @include("profile.form")  
                
            </div><!--/.col -->
            <div class="col-md-12">
                <div class="box-footer">   
                    <div class="pull-right">
                        <button type="submit" class="btn btn-info" form="frmprofile" >บันทึก</button>
                        <button type="reset" class="btn btn-default" form="frmprofile">ยกเลิก</button>
                    </div>
                </div>                
            </div>
        </div>
        
        
    </section>    
</div><!-- /.content -->

    @include('partials.confirm-modal')
@endsection

@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">

        <!-- Account Sidebar -->
        @include("user.account-sidebar")
        <!-- End Account Sidebar -->

        <!-- My Profile Content -->
        <div class="col-sm-8 col-md-9">
            <div class="title m-b-2"><span>{{ trans('user.My Profile') }}</span></div>
            <div class="col-md-12">
                @include("partials.alert-session")
            </div>
            
            <div class="form-horizontal" id="form-show-user">
                
                <div class="">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.First Name') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ $user->name }}</label>
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.Last Name') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ $user->lastname }}</label>
                        </div>
                    </div>                     
                </div>                
                <div class="">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.Sex') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ !empty($user->sex) ? $user->sex : '-' }}</label>
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.Birth Day') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">
                                <?php 
                                if(empty($user->birthday) || $user->birthday == '0000-00-00'){
                                    echo '-';
                                }else{
                                    echo DateTime($user->birthday);                                    
                                }
                                ?>
                            </label>
                        </div>
                    </div>                     
                </div>
                <div class="">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('common.Email address') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ $user->email }}</label>
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.Phone Number') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ !empty($user->tel) ? $user->tel : '-' }}</label>
                        </div>
                    </div>                     
                </div>
                <div class="">
                    <a href="javascript:void(0)" id="show-form-user" onclick="$('#form-edit-user').show();$('#form-show-user').hide();return false;"  class="btn btn-theme pull-right"><i class="fa fa-pencil"></i> {{ trans('user.Edit My Profile') }}</a>
                </div>
                
            </div>    
                
            
            <div class="form-horizontal" id="form-edit-user" style="display: none">   
                {!! Form::model($user, ['route' => ['user.update'], 'method' => 'POST', 'files' => true, 'id'=>'frmuser']) !!}
                <div class="">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label required_field">{{ trans('user.First Name') }}</label>
                        <div class="col-sm-8">
                            {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label class="col-sm-4 control-label required_field">{{ trans('user.Last Name') }}</label>
                        <div class="col-sm-8">      
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                        </div>
                    </div>
                </div>
                 <div class="">
                    <div class="form-group col-sm-6">
                        <label for="p_name" class="col-sm-4 control-label">{{ trans('user.Sex') }}</label>
                        <div class="col-sm-8">
                            <div class="radio-inline">
                                <label>
                                    {!! Form::radio('sex', 'ชาย'); !!} 
                                    <!--<input type="radio" name="sex" value="ชาย" {{ $user->sex == "ชาย" ? "checked" : "" }} >-->
                                    <span>ชาย</span>
                                
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label>
                                    {!! Form::radio('sex', 'หญิง'); !!} 
                                    <!--<input type="radio" name="sex" value="หญิง" {{ $user->sex == "หญิง" ? "checked" : "" }}>-->
                                    <span>หญิง</span></label>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label">{{ trans('user.Birth Day') }}</label>
                        <div class="col-sm-8">                         
                            <div class='input-group date' id='datetimepicker2'>  
                                {!! Form::text('birthday', null, ['class' => 'form-control datepicker']) !!} 
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 control-label required_field">{{ trans('common.Email address') }}</label>
                        <div class="col-sm-8"> 
                            <label class="control-label font-normal">{{ $user->email }}</label>
                        </div>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label for="type_product_id" class="col-sm-4 control-label">{{ trans('user.Phone Number') }}</label>
                        <div class="col-sm-8">  
                        {!! Form::text('tel', null, ['class' => 'form-control']) !!} 
                        </div>
                    </div>
                </div>
                 <div class="">
                    <div class="text-center">
                       <button type="submit" class="btn btn-theme">{{ trans('common.save') }}</button>
                       <a href="{{ url(customer()) }}" class="btn btn-default load-form">{{ trans('common.cancel') }}</a>
                   </div>
                </div>     
                {!! Form::close() !!}
            </div>
            
        </div>
        <!-- End My Profile Content -->
        
    </div>
</div>
@endsection


@section('stylesheet')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ URL::asset('plugins/datepicker/datepicker3.css') }}">
@endsection  
  
@section('script')
<!-- bootstrap datepicker -->
<script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('shop/js/customer.js') }}"></script>
@endsection
@section('script-custom')
<script>
     $(function () {
        $('.datepicker').datepicker({          
          format: 'yyyy-mm-dd',
          autoclose: true,
        });             
    });
</script>
@endsection
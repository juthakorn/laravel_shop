@extends('layouts.standard_v2')

@section('content')

             
<div class="container-fluid limited mb-5">
    <div class="row">
        
        <!-- Account Sidebar -->
        @include("user.account-sidebar_v2")
        <!-- End Account Sidebar -->
        
        <div class="col-lg-9 col-md-8">
            
            
            <div id="form-show-user">
             
            <div class="title"><span>{{ trans('user.My Profile') }}</span><button class="btn btn-sm btn-outline-theme float-right" onclick="$('#form-edit-user').show();$('#form-show-user').hide();return false;"><i class="material-icons">mode_edit</i> {{ trans('user.Edit My Profile') }}</button></div>
            @include("partials.alert-session")
            <table class="table mb-3 table-sm">
                <tbody>
                    <tr>
                        <td class="border-top-0">
                            <strong>{{ trans('user.First Name') }}</strong>
                            <div>{{ $user->name }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>{{ trans('user.Last Name') }}</strong>
                            <div>{{ $user->lastname }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>{{ trans('user.Sex') }}</strong>
                            <div>{{ !empty($user->sex) ? $user->sex : '-' }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>{{ trans('user.Birth Day') }}</strong>
                            <div>
                                <?php 
                                if(empty($user->birthday) || $user->birthday == '0000-00-00'){
                                    echo '-';
                                }else{
                                    echo DateTime($user->birthday);                                    
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>{{ trans('common.Email address') }}</strong>
                            <div>{{ $user->email }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>{{ trans('user.Phone Number') }}</strong>
                            <div>{{ !empty($user->tel) ? $user->tel : '-' }}</div>
                        </td>
                    </tr>                    
                </tbody>
            </table>
            
            </div>
            
          
            
            <div id="form-edit-user" style="display: none">
            <div class="title"><span>{{ trans('user.My Profile') }}</span></div>
            
                {!! Form::model($user, ['route' => ['user.update'], 'method' => 'POST', 'files' => true, 'id'=>'frmuser', 'class' => 'mt-2']) !!}
          
                
                <div class="form-row">
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputCountry" class="mb-0 mb-md-2 required_field">{{ trans('user.First Name') }}</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                    </div>
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputZip" class="mb-0 mb-md-2 required_field">{{ trans('user.Last Name') }}</label>
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                    </div>
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputCity" class="mb-0 mb-md-2">{{ trans('user.Sex') }}</label>
                        <!--<input type="text" class="form-control" id="inputCity">-->
                        <div class="mb-0 mb-md-2">
                            <div class="form-check form-check-inline">
                                {!! Form::radio('sex', 'ชาย' , null , ['class' => 'form-check-input', 'id' => 'inlineRadio1']); !!} 
                                <label class="form-check-label" for="inlineRadio1"> ชาย</label>
                            </div>
                            <div class="form-check form-check-inline">
                                {!! Form::radio('sex', 'หญิง' , null, ['class' => 'form-check-input', 'id' => 'inlineRadio2']); !!} 
                                <label class="form-check-label" for="inlineRadio2"> หญิง</label>
                            </div>                            
                        </div>
                    </div>
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputRegion" class="mb-0 mb-md-2">{{ trans('user.Birth Day') }}</label>
                        <div class="input-group mb-2 mr-sm-2">   
                            {!! Form::text('birthday', null, ['class' => 'form-control datepicker']) !!} 
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">date_range</i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputCountry" class="mb-0 mb-md-2">{{ trans('common.Email address') }}</label>
                        <label class="form-control" style="background-color: #e9ecef">{{ $user->email }}</label>
                    </div>
                    <div class="form-group mb-1 mb-md-3 col-md-6">
                        <label for="inputCountry" class="mb-0 mb-md-2">{{ trans('user.Phone Number') }}</label>
                        {!! Form::text('tel', null, ['class' => 'form-control']) !!} 
                    </div>
                </div> 
                <button type="submit" class="btn btn-theme my-1"><i class="material-icons">save</i> {{ trans('common.save') }}</button>
                <a href="{{ url(customer()) }}" class="btn btn-secondary">{{ trans('common.cancel') }}</a>
            {!! Form::close() !!}
            </div>
            
            
        </div>
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
<script src="{{ URL::asset('shop-v2/js/customer.js') }}"></script>
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
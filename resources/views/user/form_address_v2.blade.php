<div>  
    {!! Form::model($address,[
    'route' => $address->exists ? ['address.update', $address->id] : 'address.create',
    'method' => 'POST',
    'id'=>'form-address', 'class' => 'form-address'
    ]) !!}  
        
        <div class="form-group row">
            <label  class="col-md-3 col-form-label required_field">{{ trans('user.First Name') }}</label>
            <div class="col-md-7">
                {!! Form::text('firstname', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div> 
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Last Name') }}</label>
            <div class="col-md-7">      
                {!! Form::text('lastname', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Address') }}</label>
            <div class="col-md-7"> 
                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows'=>'2', 'required'=>'true']) !!}                                   
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Sub-district') }}</label>
            <div class="col-md-7">      
                {!! Form::text('sub_district', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.District') }}</label>
            <div class="col-md-7">      
                {!! Form::text('district', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Province') }}</label>
            <div class="col-md-7">      
                {!! Form::select('province',$province, null, ['class' => 'form-control', 'required'=>'true']) !!}               
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Postal Code') }}</label>
            <div class="col-md-7">      
                {!! Form::text('postcode', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label required_field">{{ trans('user.Phone Number') }}</label>
            <div class="col-md-7">      
                {!! Form::text('tel', null, ['class' => 'form-control', 'required'=>'true']) !!} 
            </div>
        </div>
    


        <div class="text-center">
            <button type="submit" class="btn btn-theme my-1"><i class="material-icons">save</i> {{ trans('common.save') }}</button>
            <a href="{{ url(customer_address()) }}" class="btn btn-secondary">{{ trans('common.cancel') }}</a>
            
        </div>
      
    {!! Form::close() !!}
</div>
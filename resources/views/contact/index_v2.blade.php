@extends('layouts.standard_v2')

@section('content')

<div class="container-fluid limited mb-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="title"><span>{{ trans('common.Contact Us') }}</span></div>

            @include("partials.alert-session")
            {!! Form::model($contact,[
            'url' => UrlContactUs(),
            'method' => 'POST',
            'id'=>'form-address'
            ]) !!} 
                <div class="form-group">
                    <label class="required_field">{{ trans('common.contact_name') }}</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                </div>
                <div class="form-group">
                    <label class="required_field">{{ trans('common.Email address') }}</label>
                    {!! Form::email('email', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                </div>
                <div class="form-group">
                    <label class="required_field">{{ trans('common.Subject') }}</label>
                    {!! Form::text('subject', null, ['class' => 'form-control', 'required'=>'true']) !!} 
                </div>
                <div class="form-group">
                    <label class="required_field">{{ trans('common.Message') }}</label>
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'rows'=>'3', 'required'=>'true']) !!}    
                </div>
            
                <div class="form-group">
                <div class="code_wrap">
                    <?= captcha_img('flat'); ?>
                    <button type="button" class="refresh reload-captcha btn-theme"><span class="fa fa-refresh"></span></button>
                </div>
                {!! Form::text('result_captcha', null, ['class' => 'form-control result_captcha', 'placeholder' => trans('common.Security code'), 'required'=>'true']) !!} 
            </div>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-theme pull-right">Send <i class="fa fa-arrow-circle-right"></i></button>
            {!! Form::close() !!}
                <!--<button type="submit" class="btn btn-theme btn-sm">Submit</button>-->
            
        </div>
        
        <div class="col-md-4">
            <div class="title"><span>{{ trans('common.Contact Us') }}</span></div>
            <ul class="list-group mb-4">
                <li class="list-group-item pl-2 border-left-0 border-right-0 border-top-0">
                    <span class="btn btn-theme" style="display: table-cell;"><i class="fa fa-map-marker"></i></span> 
                    <?php $temp_address = check_province($address->province); ?>
                    <span style="display: table-cell;padding-left: 6px;"><?= $address->address . " " . $temp_address['txttombon'] . $address->district . " " . $temp_address['txtumpher'] . $address->city . " <br>จังหวัด" . $address->province . " " . $address->postcode ?></span>
                </li>
                <li class="list-group-item pl-2 border-left-0 border-right-0"><span class="btn btn-info"><i class="fa fa-phone"></i></span> {{ $address->tel }}</li>
                <li class="list-group-item pl-2 border-left-0 border-right-0"><a href="{{ "mailto:".$address->email }}" target="_top" class="btn btn-warning" style="padding: 5px 10px;"><i class="fa fa-envelope"></i></a> <a href="{{ "mailto:".$address->email }}" target="_top">{{ $address->email }}</a></li>
                <li class="list-group-item pl-2 border-left-0 border-right-0"><a href="{{ $address->social_facebook }}" target="_blank" class="btn btn-primary"><i class="fa fa-facebook"></i></a> <a href="{{ $address->social_facebook }}" target="_blank">{{ $address->social_facebook }}</a></li>
                <li class="list-group-item pl-2 border-left-0 border-right-0"><a href="{{ $address->social_line }}" target="_blank" class="btn btn-success" style="padding: 0px 9px 4px 9px;font-size: 1.4em;"><span>@</span></a> <a href="{{ $address->social_line }}" target="_blank">@tm_shop</a></li>


            </ul>
            
            <!-- Location Map -->
            <div class="title"><span>{{ trans('common.Our Location') }}</span></div>
            <div class="embed-responsive embed-responsive-4by3 rounded">
                <?= !empty($address->google_map) ? $address->google_map : ""; ?>
                <!--<iframe class="embed-responsive-item" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=central%2Bpark&ie=UTF8&z=12&t=m&iwloc=near&output=embed"></iframe>-->
            </div>
            <!-- End Location Map -->
            
            
        </div>
    </div>
</div>

@endsection


@section('script')
<script type="text/javascript">
    $('.reload-captcha').on('click', function (e) {
        e.preventDefault();
        var $captcha = $(this).siblings('img');
        var src = $captcha.attr('src');
        $captcha.attr('src', updateQueryStringParameter(src, 't', new Date().getTime()));
        return false;
    });

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }
</script>
@endsection
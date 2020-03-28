@extends('layouts.standard_v2')

@section('content')
<div class="breadcrumb-container">
    <div class="container-fluid limited">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ trans('common.Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Page not Found</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid limited mb-5">
    <div class="row">
        <div class="col text-center">
            <div class="alert alert-info" role="alert">
                <img src="{{ URL::asset('shop-v2/img/cart_404.png') }}" alt="" style="margin-top: 3rem"/>
                <h1 class="roboto-condensed"><i class="material-icons md-3">error_outline</i> Error 404 Page Not Found</h1>

                <div class="btn-group btn-group-sm mt-3 mb-5" role="group" aria-label="error 404 action">
                    <a class="btn btn-outline-theme" href="javascript:history.back()" role="button"><i class="fa fa-arrow-left"></i> Go Back</a>
                    <a class="btn btn-theme" href="{{ url('/') }}" role="button"><i class="fa fa-home"></i> {{ trans('common.Home') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

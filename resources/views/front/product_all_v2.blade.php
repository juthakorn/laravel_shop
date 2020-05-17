@extends('layouts.standard_v2')

@section('content')
<div class="container-fluid limited mb-5">
    <div class="row">


        <!-- Filter Widget -->
        <div class="col-lg-3 mb-3">
            @include("partials.category-left_v2")
        </div>
        <!-- /Filter Widget -->


        <div class="col-lg-9">
            <!--<div class="title"><span>{{ trans('cart.Payment') }}</span></div>-->    
            <div class="title"><span>{{ trans('common.Products') }}</span></div>

            
        </div>
    </div>
</div>



@endsection

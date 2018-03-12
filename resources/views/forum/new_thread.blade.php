@extends('layouts.standard')

@section('content')
<div class="container m-t-3">
    <div class="row">
        <div class="col-sm-3">
            @include("partials.category-left")
            @include("forum.bast-sell-left") 
        </div>
        <div class="col-sm-9">
           <div class="title"><span>{{ trans('common.Post New Thread') }}</span></div>
            @include("forum.form")    
            
        </div>

    </div>
</div>

@endsection



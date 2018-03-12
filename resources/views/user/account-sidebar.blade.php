<div class="col-sm-4 col-md-3 m-b-3">
    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="account-picture box-overlay">
            <img src="{{ !empty(Auth::user()->user_image) ? url(Auth::user()->user_image) : url('/shop/images/demo/user.png') }}" id="user_image" alt="" class="img-circle img-responsive">
            <div class="fileUpload btn btn-theme">
                <i class="glyphicon glyphicon-picture"></i> <span><?= !empty(Auth::user()->user_image) ? trans('user.Change image') : trans('user.Upload image') ?></span>
                <input type="file" id="btn-upload" class="upload" name="user_image" data-href="{{ url('customer/user_upload_image') }}" />
            </div>  
            <div class="overlay" style="display: none">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </form>



    <h4 class="text-center m-b-3">{{ Auth::user()->name." ".Auth::user()->lastname }}</h4>
    <ul class="nav nav-pills nav-stacked">
        <li role="presentation" class="{{ Request::is(customer()) ? "active" : "" }}"><a href="{{ url(customer()) }}">{{ trans('user.My Profile') }} <i class="fa fa-user"></i></a></li>
        <li role="presentation" class="{{ Request::is(customer_address()) || Request::is(customer_address_edit('*')) ? "active" : "" }}"><a href="{{ url(customer_address()) }}">{{ trans('user.My Address') }} <i class="fa fa-home"></i></a></li>
        <li role="presentation" class="{{ Request::is(customer_order()) || Request::is(customer_order_detail("*")) || Request::is(UrlPaymentinfo("*")) ? "active" : "" }}"><a href="{{ url(customer_order()) }}">{{ trans('common.my_order') }} <i class="fa fa-shopping-cart"></i></a></li>
        <li role="presentation" class="{{ Request::is(change_password()) ? "active" : "" }}"><a href="{{ url(change_password()) }}">{{ trans('user.Change Password') }} <i class="fa fa-cog"></i></a></li>
    </ul>
</div>
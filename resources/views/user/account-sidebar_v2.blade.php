<div class="col-lg-3 col-md-4 mb-4 mb-md-0">
    <div class="card user-card">
        <div class="card-body p-2 mb-3 mb-md-0 mb-xl-3">
            <div class="">
                <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="account-picture box-overlay">
                    <img src="{{ !empty(Auth::user()->user_image) ? url(Auth::user()->user_image) : url('/shop/images/demo/user.png') }}" id="user_image" alt="" class="rounded-circle">
                    <div class="fileUpload btn btn-theme">
                        <i class="glyphicon glyphicon-picture"></i> <span><?= !empty(Auth::user()->user_image) ? trans('user.Change image') : trans('user.Upload image') ?></span>
                        <input type="file" id="btn-upload" class="upload" name="user_image" data-href="{{ url('customer/user_upload_image') }}" />
                    </div> 
                    <div class="overlay" style="display: none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                </form>
                <div class="text-center">
                    <h5 class="user-name">{{ Auth::user()->name." ".Auth::user()->lastname }}</h5>
                    
                </div>
            </div>
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ url(customer()) }}" class="list-group-item list-group-item-action {{ Request::is(customer()) ? "active" : "" }}"><i class="material-icons">person</i> {{ trans('user.My Profile') }}</a>            
            <a href="{{ url(customer_order()) }}" class="list-group-item list-group-item-action {{ Request::is(customer_order()) || Request::is(customer_order_detail("*")) || Request::is(UrlPaymentinfo("*")) ? "active" : "" }}"><i class="material-icons">shopping_cart</i> {{ trans('common.my_order') }}</a>
            <a href="{{ url(customer_address()) }}" class="list-group-item list-group-item-action {{ Request::is(customer_address()) || Request::is(customer_address_edit('*')) ? "active" : "" }}"><i class="material-icons">location_on</i> {{ trans('user.My Address') }}</a>
            <a href="{{ url(change_password()) }}" class="list-group-item list-group-item-action {{ Request::is(change_password()) ? "active" : "" }}"><i class="material-icons">vpn_key</i> {{ trans('user.Change Password') }}</a>
            <a href="{{ url('/logout') }}" class="list-group-item list-group-item-action d-none d-md-block"><i class="material-icons">exit_to_app</i> {{ trans('common.logout') }}</a>
        </div>
    </div>
</div>

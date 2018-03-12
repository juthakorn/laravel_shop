<div class="middle-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3 logo"> 
                <a href="{{ url('/') }}"><img alt="Logo" src="{{ url('shop/images/logo-teal.png') }}" class="img-responsive" /></a>
            </div>
            <div class="col-sm-8 col-md-6 search-box m-t-2">
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Search here..." placeholder="Search here...">
                    <div class="input-group-btn">
                        <select class="selectpicker hidden-xs" data-width="150px">
                            <option value="0">All Categories</option>
                            <option value="1">Dresses</option>
                            <option value="2">Tops</option>
                            <option value="3">Bottoms</option>
                            <option value="4">Jackets / Coats</option>
                            <option value="5">Sweaters</option>
                            <option value="6">Gym Wear</option>
                            <option value="7">Others</option>
                        </select>
                        <button type="button" class="btn btn-default btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 cart-btn hidden-xs m-t-2">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-shopping-cart"></i> Shopping Cart : <span id="sum_qty"></span> items <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right box-overlay box-overlay2" aria-labelledby="dropdown-cart"  id="dropdown-cart">
                    
                    @include("cart.dropdown-cart") 
                    
                </div>
            </div>
        </div>
    </div>
</div>
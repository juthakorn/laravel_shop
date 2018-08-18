<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ !empty(Auth::user()->user_image) ? url(Auth::user()->user_image) : url('/shop/images/demo/user.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name." ".Auth::user()->lastname }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION<?= Request::segment(1)?></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
                </a>          
            </li>
            <li class="treeview {{ Request::segment(2) == "order" ? "active" : "" }}">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>รายการสั่งซื้อ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is(UrlAdminOrder()) ? "active" : "" }}"><a href="{{ url(UrlAdminOrder()) }}"><i class="fa fa-circle-o"></i>รายการสั่งซื้อทั้งหมด</a></li>
                    <li><a href="editors.html"><i class="fa fa-circle-o"></i>รายการรอยืนยันการชำระเงิน</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>รายการรอการจัดส่ง</a></li>
                    <li><a href="editors.html"><i class="fa fa-circle-o"></i>รายการสั่งซื้อสำเร็จ</a></li>                    
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == "category" || Request::segment(2) == "size" || Request::segment(2) == "product" ? "active" : "" }}">
                <a href="#">
                    <i class="fa fa-tags"></i> <span>สินค้า</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php /* <li class="{{ Request::is('admin/type_product') ? "active" : "" }}"><a href="{{ url('/admin/type_product') }}"><i class="fa fa-circle-o"></i>จัดการประเภทสินค้า</a></li>
                    <li class="{{ Request::is('admin/type_product/create') ? "active" : "" }}"><a href="{{ url('/admin/type_product/create') }}"><i class="fa fa-circle-o"></i>เพิ่มประเภทสินค้า</a></li>*/?>
                    <li class="{{ Request::is('admin/category') ? "active" : "" }}"><a href="{{ url('/admin/category') }}"><i class="fa fa-circle-o"></i>จัดการหมวดหมู่สินค้า</a></li>   
                    <li class="{{ Request::is('admin/category/create') ? "active" : "" }}"><a href="{{ url('/admin/category/create') }}"><i class="fa fa-circle-o"></i>เพิ่มหมวดหมู่สินค้า</a></li>
                    <li class="{{ Request::is('admin/product') ? "active" : "" }}"><a href="{{ url('/admin/product') }}" ><i class="fa fa-circle-o"></i>จัดการสินค้า</a></li>
                    <li class="{{ Request::is('admin/product/create') ? "active" : "" }}"><a href="{{ url('/admin/product/create') }}"><i class="fa fa-circle-o"></i>เพิ่มสินค้า</a></li>
                    <li class="{{ Request::is('admin/size') ? "active" : "" }}"><a href="{{ url('/admin/size') }}"><i class="fa fa-circle-o"></i>จัดการรายละเอียดไซส์</a></li>
                </ul>
                
                
            </li>
            <li class="treeview {{ Request::segment(2) == "bank" ? "active" : "" }}">
                <a href="#">
                    <i class="fa fa-money"></i> <span>การเงิน</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="editors.html"><i class="fa fa-circle-o"></i>แจ้งชำระเงินแทน</a></li>
                    <li class="{{ Request::is('admin/bank') ? "active" : "" }}"><a href="{{ url('/admin/bank') }}"><i class="fa fa-circle-o"></i>บัญชีธนาคาร</a></li>
                    
                    
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == "code_discount" ? "active" : "" }}">
                <a href="#">
                    <i class="fa fa-star-o"></i> <span>โปรโมชั่น</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>ลดราคา</a></li>
                    <li class="{{ Request::is('admin/code_discount') ? "active" : "" }}"><a href="{{ url('/admin/code_discount') }}"><i class="fa fa-circle-o"></i>รหัสส่วนลด</a></li>
                    
                    
                </ul>
            </li>
            <li class="treeview {{ Request::segment(2) == "blog" ? "active" : "" }}">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>บทความ</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin/blog') }}"><i class="fa fa-circle-o"></i>รายการบทความ</a></li>
                    <li class="{{ Request::is('/admin/blog/create') ? "active" : "" }}"><a href="{{ url('/admin/blog/create') }}"><i class="fa fa-circle-o"></i>เพิ่มบทความ</a></li>
                    
                    
                </ul>
            </li>
            <li class="{{ Request::is('admin/image') ? "active" : "" }}">
                <a href="{{ url('/admin/image') }}">
                    <i class="fa fa-fw fa-file-image-o"></i> <span>คลังรูปภาพ</span>            
                </a>
            </li>
            <li class="{{ Request::is('admin/profile') ? "active" : "" }}">
                <a href="{{ url('/admin/profile') }}">
                    <i class="fa fa-fw fa-gears"></i> <span>ข้อมูลร้านค้า</span>            
                </a>
            </li>            
<!--            <li>
                <a href="#">
                    <i class="fa fa-calendar"></i> <span>xxxxxxxxxx</span>            
                </a>
            </li>-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
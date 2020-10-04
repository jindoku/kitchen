<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" menu-title-theme="theme5">Quản lý</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('staff.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">Quản lý nhân viên</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('customer.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Quản lý khách hàng</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('category-product.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                    <span class="pcoded-mtext">Quản lý nhóm hàng</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('product.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                    <span class="pcoded-mtext">Quản lý thiết bị</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('bill.index')}}">
                    <span class="pcoded-micon"><i class="feather icon-file-minus"></i></span>
                    <span class="pcoded-mtext">Quản lý hóa đơn</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

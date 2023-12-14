<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ Request::route()->getName() == 'admin.home' ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <img src="{{ asset('assets/img/icons/product.svg') }}" alt="img">
                        <span>Product</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <img src="{{ asset('assets/img/icons/category.svg') }}" alt="img">
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/color*') ? 'active' : '' }}">
                    <a href="{{ route('admin.color.index') }}">
                        <img src="{{ asset('assets/img/icons/color.svg') }}" alt="img">
                        <span>Color</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/size*') ? 'active' : '' }}">
                    <a href="{{ route('admin.size.index') }}">
                        <img src="{{ asset('assets/img/icons/size.svg') }}" alt="img">
                        <span>Size</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/coupon*') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupon.index') }}">
                        <img src="{{ asset('assets/img/icons/coupon.svg') }}" alt="img">
                        <span>Coupon</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
                    <a href="{{ route('admin.order.index') }}">
                        <img src="{{ asset('assets/img/icons/order.svg') }}" alt="img">
                        <span>Order</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}">
                        <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img">
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/banner*') ? 'active' : '' }}">
                    <a href="{{ route('admin.banner.index') }}">
                        <img src="{{ asset('assets/img/icons/notification-bing.svg') }}" alt="img">
                        <span>Banners</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/testimonial*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonial.index') }}">
                        <img src="{{ asset('assets/img/icons/testimonial.svg') }}" alt="img">
                        <span>Testimonial</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/section*') ? 'active' : '' }}">
                    <a href="{{ route('admin.section.index') }}">
                        <img src="{{ asset('assets/img/icons/section.svg') }}" alt="img">
                        <span>Section</span>
                    </a>
                </li>
                {{-- <li class="submenu">
                    <a href="javascript:void(0);">
                        <img src="{{ asset('assets/img/icons/product.svg') }}" alt="img">
                        <span>Product</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.product.index') }}"
                                class="{{ request()->is('admin/product*') ? 'active' : '' }}">
                                Product List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}"
                                class="{{ request()->is('admin/category*') ? 'active' : '' }}">
                                Category List
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Brand List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.color.index') }}"
                                class="{{ request()->is('admin/color*') ? 'active' : '' }}">
                                Color List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.size.index') }}"
                                class="{{ request()->is('admin/size*') ? 'active' : '' }}">
                                Size List
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/sales1.svg') }}"
                            alt="img"><span>
                            Sales</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="saleslist.html">Sales List</a></li>
                        <li><a href="pos.html">POS</a></li>
                        <li><a href="pos.html">New Sales</a></li>
                        <li><a href="salesreturnlists.html">Sales Return List</a></li>
                        <li><a href="createsalesreturns.html">New Sales Return</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/purchase1.svg') }}"
                            alt="img"><span>
                            Purchase</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="purchaselist.html">Purchase List</a></li>
                        <li><a href="addpurchase.html">Add Purchase</a></li>
                        <li><a href="importpurchase.html">Import Purchase</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/return1.svg') }}"
                            alt="img"><span>
                            Return</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="salesreturnlist.html">Sales Return List</a></li>
                        <li><a href="createsalesreturn.html">Add Sales Return </a></li>
                        <li><a href="purchasereturnlist.html">Purchase Return List</a></li>
                        <li><a href="createpurchasereturn.html">Add Purchase Return </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }}"
                            alt="img"><span>
                            People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="customerlist.html">Customer List</a></li>
                        <li><a href="addcustomer.html">Add Customer </a></li>
                        <li><a href="supplierlist.html">Supplier List</a></li>
                        <li><a href="addsupplier.html">Add Supplier </a></li>
                        <li><a href="userlist.html">User List</a></li>
                        <li><a href="adduser.html">Add User</a></li>
                        <li><a href="storelist.html">Store List</a></li>
                        <li><a href="addstore.html">Add Store</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/places.svg') }}"
                            alt="img"><span>
                            Places</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="newcountry.html">New Country</a></li>
                        <li><a href="countrieslist.html">Countries list</a></li>
                        <li><a href="newstate.html">New State </a></li>
                        <li><a href="statelist.html">State list</a></li>
                    </ul>
                </li> --}}
                {{-- <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/users1.svg') }}"
                            alt="img"><span>
                            Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="newuser.html">New User </a></li>
                        <li><a href="userlists.html">Users List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/settings.svg') }}"
                            alt="img"><span>
                            Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="generalsettings.html">General Settings</a></li>
                        <li><a href="emailsettings.html">Email Settings</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('admin.order.index') }}"
                        class="{{ request()->is('admin/order*') ? 'active' : '' }}">
                        <img src="{{ asset('assets/img/icons/sales1.svg') }}" alt="img">
                        <span>Order</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>

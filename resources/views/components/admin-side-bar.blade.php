<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ Auth::user()->name }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('admin/dashboard') }}" class="has-arrow">
                <div class=""><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>

        <li class="menu-label">Home</li>
        <li>
            <a href="{{ url('admin/home_banner') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Home Banner</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/manage_size') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Manage Size</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/manage_color') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Manage Color</div>
            </a>
        </li>

        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Attributes</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('admin/attribute_name') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Attribute Name</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/attribute_value') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Attribute value</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('admin/category') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Category</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/category_attribute') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Attribute</div>
                    </a>
                </li>

            </ul>
        </li>

        <li>
            <a href="#">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li>
                    <a href="{{ url('admin/product') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Product</div>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ url('admin/category_attribute') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i>
                        </div>
                        <div class="menu-title">Attribute</div>
                    </a>
                </li> --}}

            </ul>
        </li>

        <li class="menu-label">Brand</li>
        <li>
            <a href="{{ url('admin/brand') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
        </li>
        <li class="menu-label">Tax</li>
        <li>
            <a href="{{ url('admin/tax') }}">
                <div class="parent-icon"><i class='bx bx-home'></i>
                </div>
                <div class="menu-title">Tax</div>
            </a>
        </li>
        <li class="menu-label">Pages</li>

        <li>
            <a href="{{ url('admin/profile') }}" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>


    </ul>
    <!--end navigation-->
</div>

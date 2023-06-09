<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-view-dashboard"></i>
                <span class="menu-title px-4">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/category') || Request::is('admin/category/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="{{ Request::is('admin/category') ? 'true' : 'false' }}"
                aria-controls="categories">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/category') ? 'show' : '' }}" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">Add
                            Category</a></li>
                    <li class="nav-item"> <a class="nav-link"href="{{ url('admin/category') }}">View Category</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/products') || Request::is('admin/products/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="{{ Request::is('admin/products') ? 'true' : 'false' }}"
                aria-controls="products">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/products') || Request::is('admin/products/create') ? 'active' : '' }}" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create') }}">Add Product</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"href="{{ url('admin/products') }}">View Product</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/orders') ? 'active' : '' }}">
            <a class="nav-link"  href="{{ url('admin/orders') }}">
                <i class="mdi mdi-sale menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/sliders') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/sliders') }}">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Home Slider</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/users') }}">
                <i class="mdi mdi-account-plus menu-icon"></i>
                <span class="menu-title">User Pages</span>
            </a>
        </li>
    </ul>
</nav>

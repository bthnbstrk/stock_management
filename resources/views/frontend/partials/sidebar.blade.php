<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{url('/home')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
            <img src="https://docs.tuyap.online/KBF/Resim2990/129682.jpg" alt="Ciloglu.com" width="70">
              </span>
            <span class="app-brand-text menu-text font-bold">Stock Management</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item {{ (request()->is('home')) ? 'active' : '' }}">
            <a href="{{ url('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->is('customers*')) ? 'active' : '' }}">
            <a href="{{ url('customers') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-component"></i>
                <div data-i18n="Analytics">Customers</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->is('products*')) ? 'active' : '' }}">
            <a href="{{ url('products') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-component"></i>
                <div data-i18n="Analytics">Products</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->is('orders*')) ? 'active' : '' }}">
            <a href="{{ url('orders') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-restaurant"></i>
                <div data-i18n="Analytics">Orders</div>
            </a>
        </li>

        <li class="menu-item {{ (request()->is('stock*')) ? 'active' : '' }}">
            <a href="{{ url('stock') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Analytics">Stock</div>
            </a>
        </li>

    </ul>
</aside>

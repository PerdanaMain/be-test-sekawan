<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-semibold ms-5">VMS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->path() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <div data-i18n="CRM">Dasboard</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->path() == 'vehicles' ? 'active' : '' }}">
                    <a href="{{ route('vehicles.index') }}" class="menu-link">
                        <div data-i18n="Analytics">Vehicles</div>
                    </a>
                </li>

            </ul>
        </li>
    </ul>
</aside>

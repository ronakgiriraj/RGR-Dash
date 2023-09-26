<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/{{ getAdminUrl() }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                {{-- logo --}}
            </span>
            <span style="text-transform: inherit;" class="app-brand-text demo menu-text fw-bolder ms-2">{{ $coreSetting['site_name'] ?? env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->path() == getAdminUrl()  ? 'active' : '' }}">
            <a href="/{{ getAdminUrl() }}/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Management</span>
        </li>

        <li class="menu-item {{ str_contains(request()->path(), getAdminUrl() . '/users') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Users</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->path() == getAdminUrl() . '/users' ? 'active' : '' }}">
                    <a href="/{{ getAdminUrl() }}/users" class="menu-link">
                        <div>List</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->path() == getAdminUrl() . '/users/create' ? 'active' : '' }}">
                    <a href="/{{ getAdminUrl() }}/users/create" class="menu-link">
                        <div>Add User</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ str_contains(request()->path(), getAdminUrl() . '/roles') ? 'active open' : '' }}{{ str_contains(request()->path(), getAdminUrl() . '/permissions') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-check-shield"></i>
                <div>Roles & Permissions</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->path() == getAdminUrl() . '/roles' ? 'active' : '' }} {{ request()->path() == getAdminUrl() . '/roles/create' ? 'active' : '' }}">
                    <a href="/{{ getAdminUrl() }}/roles" class="menu-link">
                        <div>Roles</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->path() == getAdminUrl() . '/permissions' ? 'active' : '' }}">
                    <a href="/{{ getAdminUrl() }}/permissions" class="menu-link">
                        <div>Permissions</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="/{{ getAdminUrl() }}/settings" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Settings</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->

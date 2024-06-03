<div id="sidebar" class="app-sidebar" data-bs-theme="dark">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="{{ asset('assets/img/user/user-' . $randomNumber . '.jpg') }}" alt />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">{{ $user->name }}</div>
                            <div class="menu-caret ms-auto"></div>
                        </div>
                        <small>{{ $user->role->name }}</small>
                    </div>
                </a>
            </div>
            <div id="appSidebarProfileMenu" class="collapse">
                <div class="menu-item pt-5px">
                    <a href="javascript:;" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-cog"></i></div>
                        <div class="menu-text">Settings</div>
                    </a>
                </div>
                <div class="menu-divider m-0"></div>
            </div>
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">
                        Dashboard
                    </div>
                </a>
            </div>
            <div
                class="menu-item has-sub {{ Request::segment(1) == 'departement' || Request::segment(1) == 'ppn' || Request::segment(1) == 'suplier' || Request::segment(1) == 'satuan' || Request::segment(1) == 'currency' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-database"></i>
                    </div>
                    <div class="menu-text">Master</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'departement' ? 'active' : '' }}">
                        <a href="/departement" class="menu-link">
                            <div class="menu-text">Departement</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'ppn' ? 'active' : '' }}">
                        <a href="/ppn" class="menu-link">
                            <div class="menu-text">PPN</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'suplier' ? 'active' : '' }}">
                        <a href="/suplier" class="menu-link">
                            <div class="menu-text">Suplier</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'satuan' ? 'active' : '' }}">
                        <a href="/satuan" class="menu-link">
                            <div class="menu-text">Satuan</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'currency' ? 'active' : '' }}">
                        <a href="/currency" class="menu-link">
                            <div class="menu-text">Currency</div>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="menu-item has-sub {{ Request::segment(1) == 'user' || Request::segment(1) == 'role' || Request::segment(1) == 'permissions' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="menu-text">User Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'user' ? 'active' : '' }}">
                        <a href="/user" class="menu-link">
                            <div class="menu-text">User</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'role' ? 'active' : '' }}">
                        <a href="/role" class="menu-link">
                            <div class="menu-text">Role</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'permissions' ? 'active' : '' }}">
                        <a href="/permissions" class="menu-link">
                            <div class="menu-text">Permissions</div>
                        </a>
                    </div>
                </div>
            </div>
            <div
                class="menu-item has-sub {{ Request::segment(1) == 'purchaseorder' || Request::segment(1) == 'purchaseorderdet' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-cart-shopping"></i>
                    </div>
                    <div class="menu-text">Purchase</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'purchaseorder' ? 'active' : '' }}">
                        <a href="/purchaseorder" class="menu-link">
                            <div class="menu-text">Purchase Order</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop">
    <a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>

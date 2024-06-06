<div id="sidebar" class="app-sidebar" data-bs-theme="dark">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <!-- Profile Section -->
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

            <!-- Navigation Section -->
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-sitemap"></i>
                    </div>
                    <div class="menu-text">Dashboard</div>
                </a>
            </div>

            <!-- Master Section -->
            <div
                class="menu-item has-sub {{ Request::segment(1) == 'departement' || Request::segment(1) == 'ppn' || Request::segment(1) == 'suplier' || Request::segment(1) == 'satuan' || Request::segment(1) == 'currency' || Request::segment(1) == 'position' ? 'active' : '' }}">
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
                    <div class="menu-item {{ Request::segment(1) == 'position' ? 'active' : '' }}">
                        <a href="/position" class="menu-link">
                            <div class="menu-text">Position</div>
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

            <!-- User Management Section -->
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

            <!-- Purchase Section -->
            <div
                class="menu-item has-sub {{ Request::segment(1) == 'purchaseorder' || Request::segment(1) == 'purchaseorderdet' || Request::segment(1) == 'goods-receipt' ? 'active' : '' }}">
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
                    <div class="menu-item {{ Request::segment(1) == 'goods-receipt' ? 'active' : '' }}">
                        <a href="/goods-receipt" class="menu-link">
                            <div class="menu-text">Goods Receipt</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Inventory Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'inventory' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <div class="menu-text">Inventory</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'inventory' ? 'active' : '' }}">
                        <a href="/inventory" class="menu-link">
                            <div class="menu-text">Manage Inventory</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'stock-in' ? 'active' : '' }}">
                        <a href="/stock-in" class="menu-link">
                            <div class="menu-text">Stock In</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'stock-out' ? 'active' : '' }}">
                        <a href="/stock-out" class="menu-link">
                            <div class="menu-text">Stock Out</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'stock-adjustment' ? 'active' : '' }}">
                        <a href="/stock-adjustment" class="menu-link">
                            <div class="menu-text">Stock Adjustment</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Production Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'production' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-industry"></i>
                    </div>
                    <div class="menu-text">Production</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'production-order' ? 'active' : '' }}">
                        <a href="/production-order" class="menu-link">
                            <div class="menu-text">Production Orders</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'bom' ? 'active' : '' }}">
                        <a href="/bom" class="menu-link">
                            <div class="menu-text">Bill of Materials</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'work-order' ? 'active' : '' }}">
                        <a href="/work-order" class="menu-link">
                            <div class="menu-text">Work Orders</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'production-tracking' ? 'active' : '' }}">
                        <a href="/production-tracking" class="menu-link">
                            <div class="menu-text">Production Tracking</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'quality-control' ? 'active' : '' }}">
                        <a href="/quality-control" class="menu-link">
                            <div class="menu-text">Quality Control</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sales Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'sales' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="menu-text">Sales</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'sales-order' ? 'active' : '' }}">
                        <a href="/sales-order" class="menu-link">
                            <div class="menu-text">Sales Orders</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'customers' ? 'active' : '' }}">
                        <a href="/customers" class="menu-link">
                            <div class="menu-text">Customers</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'invoices' ? 'active' : '' }}">
                        <a href="/invoices" class="menu-link">
                            <div class="menu-text">Invoices</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'payments' ? 'active' : '' }}">
                        <a href="/payments" class="menu-link">
                            <div class="menu-text">Payments</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'reports' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-chart-bar"></i>
                    </div>
                    <div class="menu-text">Reports</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'sales-report' ? 'active' : '' }}">
                        <a href="/sales-report" class="menu-link">
                            <div class="menu-text">Sales Reports</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'inventory-report' ? 'active' : '' }}">
                        <a href="/inventory-report" class="menu-link">
                            <div class="menu-text">Inventory Reports</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'production-report' ? 'active' : '' }}">
                        <a href="/production-report" class="menu-link">
                            <div class="menu-text">Production Reports</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'financial-report' ? 'active' : '' }}">
                        <a href="/financial-report" class="menu-link">
                            <div class="menu-text">Financial Reports</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Human Resources Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'hr' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-users-cog"></i>
                    </div>
                    <div class="menu-text">Human Resources</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'employees' ? 'active' : '' }}">
                        <a href="/employees" class="menu-link">
                            <div class="menu-text">Employees</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'attendance' ? 'active' : '' }}">
                        <a href="/attendance" class="menu-link">
                            <div class="menu-text">Attendance</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'payroll' ? 'active' : '' }}">
                        <a href="/payroll" class="menu-link">
                            <div class="menu-text">Payroll</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Customs Management Section -->
            <div class="menu-item has-sub {{ Request::segment(1) == 'customs' ? 'active' : '' }}">
                <a href="javascript:;" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-shield-alt"></i>
                    </div>
                    <div class="menu-text">Customs Management</div>
                    <div class="menu-caret"></div>
                </a>
                <div class="menu-submenu">
                    <div class="menu-item {{ Request::segment(1) == 'customs-declaration' ? 'active' : '' }}">
                        <a href="/customs-declaration" class="menu-link">
                            <div class="menu-text">Customs Declaration</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'import-permits' ? 'active' : '' }}">
                        <a href="/import-permits" class="menu-link">
                            <div class="menu-text">Import Permits</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'export-permits' ? 'active' : '' }}">
                        <a href="/export-permits" class="menu-link">
                            <div class="menu-text">Export Permits</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'bonded-warehouse' ? 'active' : '' }}">
                        <a href="/bonded-warehouse" class="menu-link">
                            <div class="menu-text">Bonded Warehouse</div>
                        </a>
                    </div>
                    <div class="menu-item {{ Request::segment(1) == 'customs-reports' ? 'active' : '' }}">
                        <a href="/customs-reports" class="menu-link">
                            <div class="menu-text">Customs Reports</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="menu-item {{ Request::is('/log') ? 'active' : '' }}">
                <a href="/log" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <div class="menu-text">Log</div>
                </a>
            </div>

            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg" data-bs-theme="dark"></div>
<div class="app-sidebar-mobile-backdrop">
    <a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>

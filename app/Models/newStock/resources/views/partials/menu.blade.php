<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home.index") }}" class="nav-link">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    Home
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">
                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-users nav-icon">

                                    </i>
                                   User Department
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('asset_access')
                <li class="nav-item">
                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        Add New Assets
                    </a>
                </li>
            @endcan
            @can('stock_access')
                <li class="nav-item">
                    <a href="{{ route("admin.stocks.index") }}" class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        Stock
                    </a>
                </li>
            @endcan
            @can('transaction_access')
            <li class="nav-item">
                <a href="{{ route("admin.request.index") }}" class="nav-link {{ request()->is('admin/request') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-eye nav-icon">
                    </i>
                    My Request
                </a>
            </li>
        @endcan
        @can('approve_access')
        <li class="nav-item">
            <a href="{{ route("admin.requestList.index") }}" class="nav-link">
                <i class="fa-fw fas fa-eye nav-icon">
                </i>
                All Requests
            </a>
        </li>
    @endcan
            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route("admin.transactions.index") }}" class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        View Transaction
                    </a>
                </li>
            @endcan
            @can('user_management_access')
            <li class="nav-item nav-dropdown">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">
                    </i>
                    Report
                </a>
                <ul class="nav-dropdown-items">
                    @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.assetsReport.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt nav-icon">
                                </i>
                                Stock In Report
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase nav-icon">

                                </i>
                                Stock Out
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                All Request Pending
                            </a>
                        </li>
                    @endcan
                    @can('team_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-users nav-icon">
                                </i>
                               User Department
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            Change Profile
                        </a>
                    </li>
                @endcan

            @endif
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
    {{ Auth::user()->name }}
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

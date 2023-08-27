<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Noble<span>UI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Settings</li>
            <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Permissions</span>
                </a>
            </li>

            <li class="nav-item nav-category">User Management</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.create') }}" class="nav-link">Create User</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.index') }}" class="nav-link">All User</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="javascript:;" class="nav-link" onclick="event.preventDefault();this.closest('form').submit();">
                        <i class="link-icon" data-feather="log-out"></i>
                        <span class="link-title">Log Out</span>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>

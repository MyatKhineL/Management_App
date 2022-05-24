<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">MAH</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ request()->url() == route('home') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <x-menu-item link="{{ route('home') }}">Home</x-menu-item>
                </ul>
            </li>


            <x-menu-title>Management</x-menu-title>


            @can('view_employee')
            <li class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-users"></i>
                    <span>Manage Employee</span>
                </a>
                @can('view_employee')
                <ul class="dropdown-menu">

                    <x-menu-item link="{{route('employee.index')}}">Employees</x-menu-item>

                    <x-menu-item link="{{route('employee.create')}}">Create User</x-menu-item>
                </ul>
                    @endcan
                </li>
            @endcan
            @can('view_profile')
                <li
                class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-image-portrait"></i>
                    <span>Manage Profile</span>
                </a>
                <ul class="dropdown-menu">

                    <x-menu-item link="{{route('profile')}}">Profile</x-menu-item>

                </ul>
            </li>
            @endcan
            @can('view_department')
            <li
                class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-sitemap"></i>
                    <span>Manage Department</span>
                </a>
                <ul class="dropdown-menu">

                    <x-menu-item link="{{route('department.index')}}">Department</x-menu-item>

                    <x-menu-item link="{{route('department.create')}}">Create department</x-menu-item>
                </ul>
            </li>
            @endcan
            @can('view_role')
            <li
                class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-pie-chart"></i>
                    <span>Manage Role</span>
                </a>
                <ul class="dropdown-menu">

                    <x-menu-item link="{{route('role.index')}}">Role</x-menu-item>

                    <x-menu-item link="{{route('role.create')}}">Create role</x-menu-item>
                </ul>
            </li>
            @endcan
            @can('view_permission')
            <li
                class="dropdown {{ Request::is('user') ? 'active' : '' }} {{ Request::is('user/create') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-solid fa-shield-alt"></i>
                    <span>Manage Permission</span>
                </a>
                <ul class="dropdown-menu">

                    <x-menu-item link="{{route('permission.index')}}">Permission</x-menu-item>

                    <x-menu-item link="{{route('permission.create')}}">Create permission</x-menu-item>
                </ul>
            </li>
            @endcan


            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getcodiepie.com/docs" onclick="document.getElementById('logOut').submit()"
                    class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-rocket"></i>
                    Documentation</a>

                <form class="d-none" id="logOut" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
    </aside>
</div>

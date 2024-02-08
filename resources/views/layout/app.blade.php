@include('layout.header')




<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item ">
                    <a href="{{ url('/admin/dashboard') }}"
                        class="nav-link {{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                </li>

                {{-- for admin --}}
                @if (Auth::user()->user_types === 1)
                    <li class="nav-item">
                        <a href="{{ url('/admin/admin/list') }}"
                            class="nav-link {{ Request::segment(3) === 'list' ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                    {{-- for teacher --}}
                @elseif (Auth::user()->user_types === 2)
                    {{-- for student --}}
                @elseif (Auth::user()->user_types === 3)
                    {{-- for parent --}}
                @elseif (Auth::user()->user_types === 4)
                @endif


                <li class="nav-item">
                    <a href="{{ url('/logout') }}" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>

@yield('content')

</div>

@include('layout.footer')

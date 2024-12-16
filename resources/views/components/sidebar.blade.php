<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html" class="" style="width:100%">
                <span style="width: 50%">Kejari Admin</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">
                <img alt="image" class="rounded-circle" width="50" src="{{ asset('img/logo-lms.png') }}">
            </a>
        </div>
        <div class="d-flex flex-column justify-content-between" style="height: 90vh">
            <ul class="sidebar-menu">

                @if (Session('user')['role'] == 'Admin')
                    <li class="{{ Request::is('/admin/home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/home') }}"><i class="fas fa-th-large"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <li class="{{ Request::is('admin/berita') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/berita') }}"><i class="fas fa-home"></i>
                            <span>Management Berita</span></a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
</div>

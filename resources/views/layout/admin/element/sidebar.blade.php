<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a role="button"href="{{route('admin.dashboard')}}" class="brand-link">
        <span class="brand-text font-weight-light" style="font-size: 16px">Quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            </div>
            <div class="info">
                <a role="button"href="{{ route('admin.user.detail', \Illuminate\Support\Facades\Auth::user()->id)}}" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" id="category" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item set-menu-width">
                    <a role="button"href="{{route('admin.dashboard')}}" class="nav-link @yield('chart')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a role="button" href="{{route('admin.news.list')}}" class="nav-link" onclick="addClass({{1}})">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a role="button" href="{{route('admin.voucher.list')}}" class="nav-link" onclick="addClass({{2}})">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a role="button" href="{{route('admin.user.list')}}" class="nav-link" onclick="addClass({{3}})">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Người dùng
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    function addClass(index) {
        var listItems = document.querySelectorAll('#category li');
        console.log(listItems);
        // listItems.classList.remove('menu-open')
        listItems[index + 1].classList.add('menu-open')
    }
</script>

<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="/" class="brand-link navbar-info">
      <img src="{{asset('template/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">LAHAN DESA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('template/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ strtoupper(Auth::user()->name) }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('home') }}"  class="nav-link {{Request::segment(1) == 'home' ? 'active' : '' }} ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          @if (Auth::user()->level == "admin")
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{Request::segment(1) == 'master' ? 'active' : '' }} ">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('provinsi') }}" class="nav-link {{Request::segment(2) == 'provinsi' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Provinsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kabupaten</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kecamatan</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{Request::segment(1) == 'lahan' ? 'active' : '' }} ">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Lahan Desa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('inputlahan') }}" class="nav-link {{Request::segment(2) == 'inputlahan' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Data Lahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('datalahan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Lahan</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ route('lahan') }}"  class="nav-link {{Request::segment(1) == 'lahan' ? 'active' : '' }} ">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Input Data Lahan
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

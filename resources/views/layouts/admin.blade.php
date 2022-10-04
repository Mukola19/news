<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }} " />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }} " />
  <!-- Bootstrap-tagsinput style -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }} " />
  <!-- Bootstrap style -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }} " />
  <!-- Admin style -->
  <link rel="stylesheet" href="{{ asset('css/admin.css') }} " />
</head>

<body class="bg-color">
  @auth
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.main') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Адмін панель</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Статті
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item menu-item ">
                  <a href="{{ route('admin.articles.index') }}" class="nav-link">
                    <p>Всі статті</p>
                  </a>
                </li>
                <li class="nav-item menu-item ">
                  <a href="{{ route('admin.articles.create') }}" class="nav-link">
                    <p>Створити статтю</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <a href="{{ route('admin.logout') }}" class="btn btn-primary button_logout">Вийти</a>
      <!-- Main content -->
      @yield('content')
    </div>
  </div>
  @endauth

  @guest @yield('content') @endguest

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Bootstrap-tagsinput -->
  <script src="{{ asset('plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <!-- Admin -->
  <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
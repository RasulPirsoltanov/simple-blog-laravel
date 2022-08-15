<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Blog admin paneli</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('index1') }}">Sayta get</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logOut') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link  @if (Request::segment(2) == 'panel') active @endif "
                            href="{{ route('index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Admin Panel
                        </a>
                        <div class="sb-sidenav-menu-heading">Blog ideretme</div>
                        <a class="nav-link collapsed " href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Meqaleler
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse  @if (Request::segment(2) == 'meqaleler') collapse show @endif"
                            id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link  @if (Request::segment(3) == 'create') active @endif"
                                    href="{{ route('meqaleler.create') }}">Yeni meqale</a>
                                <a class="nav-link @if (Request::segment(2) == 'meqaleler' && Request::segment(3) == '') active @endif"
                                    href="{{ route('meqaleler.index') }}">Butun Meqaleler</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed " href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-brands fa-internet-explorer"></i></div>
                            Seyfe idareetmesi
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse  @if (Request::segment(3) == 'Pages') collapse show @endif"
                            id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link  @if (Request::segment(3) == 'Pages' && Request::segment(4) == '') active @endif"
                                    href="{{ route('indexPages') }}">Seyfeler</a>
                                <a class="nav-link  @if (Request::segment(4) == 'create') active @endif"
                                    href="{{ route('indexPagesCreate') }}">Yeni menyu sehifesi</a>
                                <a class="nav-link @if (Request::segment(2) == 'meqaleler' && Request::segment(3) == '') active @endif"
                                    href="{{ route('meqaleler.index') }}">Butun Meqaleler</a>
                            </nav>
                        </div>
                        <a class="nav-link @if (Request::segment(2) == 'categories') active @endif "
                            href="{{ route('indexCategories') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            Kategorialar
                            <div class="sb-sidenav-collapse-arrow"></div>
                        </a>
                        <a class="nav-link @if (Request::segment(3) == 'Configuration') active @endif "
                            href="{{ route('indexConfig') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                            Site tenzimlemeleri
                            <div class="sb-sidenav-collapse-arrow"></div>
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="container-fluid px-4">

                    <h1 class="mt-4">{{ auth()->user()->name }}</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>

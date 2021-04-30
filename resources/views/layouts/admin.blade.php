<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>@yield('title','Admin Laravel Blog')</title>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand" href="{{ route('admin.home') }}">Laravel Blog Admin</a>
		<!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
										@if (Auth::user()->isAdmin())
                    	<div class="sb-sidenav-menu-heading">ADMIN</div>
											<a class="nav-link {{ (Route::current()->getName() == 'users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">
													<div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
													Users
											</a>
										@endif

                    <div class="sb-sidenav-menu-heading">DASHBOARD</div>
                    <a class="nav-link {{ (Route::current()->getName() == 'posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}"">
											<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
												Posts
										</a>
										<a class="nav-link {{ (Route::current()->getName() == 'categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">
											<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Categories
										</a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name }}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid mt-4">
                @yield('content')
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">
											© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
										</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- App scripts -->
@section('scripts')
	<script src="{{ asset('js/app.js') }}"></script>
@show
</body>
</html>

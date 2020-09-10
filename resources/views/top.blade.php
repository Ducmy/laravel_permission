<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'I Can Fix') }}</title>
    <!-- Scripts -->
    @section('head_js')
    <script src="{{ asset('js/app.js') }}"></script>

    @show
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/top/index.css') }}" rel="stylesheet">
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    I Can FIX
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                        <li><a class="nav-link" href="{{ route('users.index') }}">Quản lý thành viên</a></li>
                        <!-- <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                        <li><a class="nav-link" href="{{ route('products.index') }}">Manage Product</a></li> -->
                        <li><a class="nav-link" href="{{ route('courses.index') }}">Quản lý khóa học </a></li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{ route('my-account') }}" class="dropdown-item">My info</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="wrap">
        <div id="banner-top" class="mb-3">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <h2 class="banner-text">ICFix- Đào tạo trực tuyến</h2>
            </div>
        </div>

        <div class="content container">
            <section id="danh-sach-khoa-hoc">
                <h5 class="text-primary">Khóa học online:</h5>
            </section>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <h6 class="text-center"> Đào tạo trực tuyến ICFix - Copy right 2020</h6>
        </div>
    </footer>
</body>

</html>
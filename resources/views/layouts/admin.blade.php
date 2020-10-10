<html lang="vn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'I Can Fix') }}</title>


    @section('head_css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    @show
    @stack('css')


    <!-- Scripts -->
    @section('head_js')
    <script src="{{ asset('js/app.js') }}"></script>
    @show
    @stack('js')
    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Raleway:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <!-- Styles -->

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    I Can FIX
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a></li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{ route('my-account') }}" class="dropdown-item">Thông tin cá nhân</a>
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
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                            <ul class="list-group">
                                @hasrole('super-admin|admin')
                                <li class="list-group-item"><a class="nav-link" href="{{ route('users.index') }}">Quản lý thành viên</a></li>
                                @endhasrole
                                @hasrole('super-admin|admin')
                                <li class="list-group-item"><a class="nav-link" href="{{ route('teachers.index') }}">Quản lý giáo viên</a></li>
                                @endhasrole
                                @hasrole('super-admin|admin|teacher')
                                <li class="list-group-item"><a class="nav-link" href="{{ route('courses.index') }}">Quản lý khóa học </a></li>
                                @endhasrole
                            </ul>
                    </div>
                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
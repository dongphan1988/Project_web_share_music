<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('/images/logo.png')}}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm pt-0 pb-0">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('images/logo.png')}}" alt="logo" style="height: 60px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="navbar-nav">
                        <a class="nav-link" href="{{ url('/') }}">TRANG CHỦ</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            BÀI HÁT
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('songs.getListNewSong')}}">Bài hát mới</a>
                            <a class="dropdown-item" href="{{route('songs.mostSong')}}">Bài hát nghe nhiều</a>
                        </div>
                    </li>


                    <li class="navbar-nav">
                        <a class="nav-link" href="{{route('playlists.getPublicPlaylist')}}">PLAYLIST</a>
                    </li>

                    <li class="navbar-nav">
                        <a class="nav-link" href="{{route('singers.index')}}">CA SĨ</a>
                    </li>

                    <li class="navbar-nav mr-auto">
                        <a class="nav-link" href="{{route('users.showMyLibrary')}}">CÁ NHÂN</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0" action="{{route('songs.searchByName')}}" method="get">
                    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Nhập tên bài hát"
                           aria-label="Search" value="{{(isset($_GET['keyword']) ? $_GET['keyword']: '')}}">
                    <button class="btn btn-light my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('songs.create')}}">Upload</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <!-- Button trigger modal -->
                            <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">
                                Đăng nhập
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Đăng nhập
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="email"
                                                           class="col-md-4 cnol-form-label text-md-right">{{ __('Email') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               name="email"
                                                               value="{{ old('email') }}" required autocomplete="email"
                                                               autofocus>

                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"
                                                               class="form-control @error('password') is-invalid @enderror"
                                                               name="password"
                                                               required autocomplete="current-password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="remember"
                                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Ghi nhớ') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Đăng nhập') }}
                                                        </button>

                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link"
                                                               href="{{ route('password.request') }}">
                                                                {{ __('Quên mật khẩu?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('user.index',Auth::id())}}">
                                    {{'Thông tin cá nhân'}}
                                </a>
                                <a class="dropdown-item" href="{{route('change.pass')}}">
                                    {{'Đổi mật khẩu'}}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Đăng xuất') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{--SESSION FLASH--}}
    <div class="container text-center mt-1">
        @if(Session::has('message'))
            <p class="container col-8 alert alert-success" id="session-flash">
                {{Session::get('message')}}
            </p>
        @elseif(Session::has('warning'))
            <p class="container col-8 alert alert-warning" id="session-flash">
                {{Session::get('warning')}}
            </p>
        @endif

        <script>
            $("document").ready(function () {
                setTimeout(function () {
                    $("#session-flash").remove();
                }, 2000); // 2 secs
            });
        </script>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
<script src="{{asset('/js/likeSong.js')}}"></script>
<script src="{{asset('/js/likePlaylist.js')}}"></script>
<script type="text/javascript" src="{{asset('js/play.js')}}"></script>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images') }}/logo.png" type="image/icon type">
    <title>Feedback System</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
</head>
@if (Session::has('Success'))
    <!---for deactivate user alert--->
    <div class="alert alert-success" role="alert">
        {{ Session::get('Success') }}
    </div>
@endif
@if (Session::has('Fail'))
    <!---for deactivate user alert--->
    <div class="alert alert-danger" role="alert" style="margin-bottom: -0.5rem !important">
        {{ Session::get('Fail') }}
    </div>
@endif

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images') }}/UpKeepLogo.svg" alt="" width="150" class="img-fluid">
                </a>
                <button class="navbar-toggler m-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse m-2" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto py-2">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login.show') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            {{-- <form class="form-inline my-2 my-lg-0" action="{{ route('search_feedback') }}" method="POST">
                                @csrf
                                <input class="form-control mr-sm-2" name="keyword" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-main" type="submit">Search</button>
                            </form> --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Feedback
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('feedback_index') }}">All Feedback</a>
                                    <a class="dropdown-item" href="{{ route('my_feedback') }}">My Feedback</a>
                                    <a class="dropdown-item" href="{{ route('feedback_select_branch') }}">Add Feedback</a>
                                    @if (Auth::user()->role != 'Staff')
                                        <a class="dropdown-item" href="{{ route('feedback_index_complete') }}">Complete
                                            Feedback</a>
                                    @endif
                                </div>
                            </li>
                            @if (Auth::user()->role == 'Admin')
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Branch
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('branch_view') }}">View</a>
                                        <a class="dropdown-item" href="{{ route('branch_add_view') }}">Add</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Zone
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('zone_view') }}">View</a>
                                        <a class="dropdown-item" href="{{ route('zone_add_view') }}">Add</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Place
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('place_view') }}">View</a>
                                        <a class="dropdown-item" href="{{ route('place_add_view') }}">Add</a>
                                    </div>
                                </li>
                                 <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        Category
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('category_view') }}">View</a>
                                        <a class="dropdown-item" href="{{ route('category_add_view') }}">Add</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" v-pre>
                                        Title
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('title_view') }}">View</a>
                                        <a class="dropdown-item" href="{{ route('title_add_view') }}">Add</a>
                                    </div>
                                </li>
                            @endif
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Setting
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->role == 'Admin')
                                        <a class="dropdown-item" href="{{ route('profile_view') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('view_register') }}">Register
                                            Staff/Admin</a>
                                        <a class="dropdown-item" href="{{ route('user_view') }}">User Manage</a>
                                        <a class="dropdown-item" href="{{ route('api_setting') }}">API Setting</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>

</html>

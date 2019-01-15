

<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>

    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/post.css')}}" rel="stylesheet" type="text/css">

    <link href="https://bootswatch.com/lumen/bootstrap.css" rel="stylesheet" type="text/css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Muhammed hamdy </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->

    <!-- Styles -->
    <script type="text/javascript" src="{{asset('js/jquery.app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



    <link href="https://bootswatch.com/lumen/bootstrap.css" rel="stylesheet" type="text/css">


    <style>
        .navbar.navbar-inverse {

            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }


    </style>
<body>
<div id="app">




    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" style="display: block">
                    <li ><a href="/">Home</a></li>
                    @if (!\auth::guest())
                    <li><a href="/posts">Posts</a></li>
                    <li><a href="/posts/create"  >Create post</a></li>

                    @if(\auth()->user()->type == 'admin')
                        <li><a href="/users">Users</a></li>
                        <li><a href="/adduser">Add User</a></li>
                    @endif
                        @endif

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style="display: block">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @if(Auth::user()->user_image)
                                    <img src="{{ URL::to('/') }}/uploaded/profile_images/{{Auth::user()->user_image}}" class="p-0 img-thumbnail" style="max-width: 27px;max-height: 27px;" >
                                @endif
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                {{--user image--}}
                                <li>
                                    <a href="/editprofile/{{auth()->user()->id}}">Edit Profile</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>






    @include('messages')
    @yield('content')
</div>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>



<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

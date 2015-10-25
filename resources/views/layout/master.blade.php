<!DOCTYPE html>
<html>
<head>
    <title>Learnit | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{!! asset('css/materialize.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('css/custom.css') !!}" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <ul id="nav-drop" class="dropdown-content">
        <li><a href="logout">Logout</a></li>
    </ul>
    <nav>
        <div class="nav-wrapper ">
            <a href="/" class="brand-logo">Learnit</a>
            <ul class="right">
                @if (! Auth::check())
                <li><a href="register" >Signup</a></li>
                <li><a href="login" >Login</a></li>
                @endif
                @if (Auth::check())
                <li><a class="dropdown-button" href="#!" data-activates="nav-drop"><i class="material-icons right">arrow_drop_down</i></a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>

@yield('content')

@include('footer')

    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <script src="{!! asset('js/materialize.min.js') !!}"></script>

<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown-button").dropdown();
        });
    </script>

</body>
</html>
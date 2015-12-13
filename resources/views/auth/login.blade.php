@extends('layout.master')

@section('title')
    Login
@endsection

@section('content')
    <div id="login-form" class="row">
        <div class="col s12 m6 l4 offset-l4">
            <div class="row card-panel">
                <div class="card-content">
                    <form method="POST" action="login">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email"  name="email" required type="text">
                                <label for="email">Username/Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" name="password" required type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                            <button class="btn waves-effect waves-light brown lighten-2 right" type="submit" name="login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="divider"></div>
                <div class="row"></div>
            <div class="row card-action">
                <div class="col s4 left">
                    <a href="login/facebook"><i id="fa-color" class="fa fa-facebook fa-3x"></i></a>
                </div>
                <div class="col s4 center la">
                    <a href="login/twitter"><i id="fa-color" class="fa fa-twitter fa-3x"></i></a>
                </div>
                <div class="col right">
                    <a href="login/github"><i id="fa-color" class="fa fa-github fa-3x"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
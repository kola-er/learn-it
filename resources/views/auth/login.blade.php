@extends('layout.master')

@section('title')
    Login
@endsection

@section('content')
    <div class="row">
        <form class="col s12 m6 l4 offset-l8" method="POST" action="login">
            {!! csrf_field() !!}
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" value="{{ old('email') }}" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
                <button class="btn waves-effect waves-light right" type="submit" name="login">
                    Login
                </button>
            </div>
        </form>

        <div class="row"></div>
        <div class="row"></div>

        <div class="row">
            <div class="col s12 m6 l4 offset-l8">
                <div class="col s4 left">
                    <a href="{{ url('login/facebook') }}"><img class="z-depth-2" height="50" width="50" src="icon/facebook.svg" /></a>
                </div>
                <div class="col s4 center">
                    <a href="{{ url('login/twitter') }}"><img class="z-depth-2" height="50" width="50" src="icon/twitter.svg" /></a>
                </div>
                <div class="col right">
                    <a href="{{ url('login/github') }}"><img class="z-depth-2" height="50" width="50" src="icon/github.svg" /></a>
                </div>
            </div>
        </div>
    </div>
@endsection
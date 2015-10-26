@extends('layout.master')

@section('title')
    Register
@endsection

@section('content')
    <div class="row">
        <form class="col s12 m6 l4 offset-l8" method="POST" action="register">
            {!! csrf_field() !!}
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="username" name="username" type="text" value="{{ old('username') }}" class="validate">
                    <label for="username">Username</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="validate">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s6">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="validate">
                    <label for="password_confirmation">Confirm password</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light right" type="submit" name="signup">
                Signup
            </button>
        </form>
    </div>
@endsection
@extends('layout.master')

@section('title')
    Register
@endsection

@section('content')
    <div id="registration-form" class="row">
        <div class="col s12 m6 l4 offset-l4">
            <div class="row card-panel">
                <div class="card-content">
                    <form method="POST" action="register">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" name="username" required type="text" value="{{ old('username') }}">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" required value="{{ old('email') }}" class="validate">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="password" type="password" name="password" required class="validate">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="password_confirmation" type="password" required name="password_confirmation" class="validate">
                                <label for="password_confirmation">Confirm password</label>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light brown lighten-2 right" type="submit" name="signup">
                            Signup
                        </button>
                    </form>
                </div>

                <div class="row"></div>
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
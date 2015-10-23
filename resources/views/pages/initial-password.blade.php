@extends('layout.master')

@section('title')
    Password Change
@endsection

@section('content')
    <div class="row">
        <form class="col s12 m6 l4 offset-l4" method="POST" action="initial-password">
            {!! csrf_field() !!}
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>
            <div class="row"></div>

            @if ( is_null($user->username) )
                <div class="row">
                    <div class="input-field col s12">
                        <input id="username" type="text" name="username" class="validate">
                        <label for="username">Username</label>
                    </div>
                </div>
            @endif
            @if ( substr($user->email, strrpos($user->email, '@', -1)) == '@learnit.com' )
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="text" name="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="input-field col s12">
                    <input id="password" type="password" name="password" class="validate">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="validate">
                    <label for="password_confirmation">Confirm password</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light right" type="submit" name="submit">
                Submit
            </button>
        </form>
    </div>
@endsection
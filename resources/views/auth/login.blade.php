@extends('layouts.app')
@section('content')
    <div class="login-wrapper columns">
        <div class="column is-8 is-hidden-mobile hero-banner" style="padding-right:0;">
            <section class="hero is-fullheight is-dark">
            </section>
        </div>
        <div class="column is-one-third-desktop is-full-tablet is-full-mobile login-form" style="padding-left:0;">
            <section class="hero is-fullheight">
                <div class="hero-heading">
                    <div class="section has-text-centered company-name-box">
                        <h1 class="title company-name">Non Secure Programs</h1>
                    </div>
                </div>
                <div class="hero-body">
                    <div class="container neg-margin-top-100">
                        <div class="columns">
                            <div class="column is-8 is-offset-2">
                                <form action="{{ route('login') }}" method="POST" role="form">
                                    {{ csrf_field() }}
                                    <div class="login-form">
                                        @if ($errors->has('username'))
                                            <p class="help is-danger"
                                               style="margin-top: -10px;">{{ $errors->first('username') }}</p>
                                        @endif
                                        <label class="label" for="username">Username</label>
                                        <p class="control has-icon has-icon-right" style="margin-bottom:20px;">
                                            <input class="input email-input {{ $errors->has('username') ? 'is-danger' : '' }}"
                                                   type="text" name="username" value="{{ old('username') }}"
                                                   placeholder="Username">
                                            <span class="icon user">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        </p>
                                        <label for="password" class="label">Password</label>
                                        <p class="control has-icon has-icon-right" style="">
                                            <input class="input password-input {{ $errors->has('password') ? 'is-danger' : '' }}"
                                                   type="password" name="password" placeholder="●●●●●●●">
                                            <span class="icon user">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        </p>
                                        @if ($errors->has('password'))
                                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                        <p class="control login">
                                            <button type="submit"
                                                    class="button is-primary is-outlined is-large is-fullwidth">
                                                Login
                                            </button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
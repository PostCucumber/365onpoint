@extends('layouts.app')
@section('content')
<section class="hero is-fullheight is-info is-bold">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-4 is-offset-4">
                    <h1 class="title">
                    Register an Account
                    </h1>
                    <div class="box">
                        <form action="{{ route('register') }}" method="POST" role="form">
                            {{ csrf_field() }}
                            <label class="label">Name</label>
                            <p class="control">
                                <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" placeholder="First and last name" name="name" value="{{ old('name') }}" required autofocus style="margin-bottom: 20px;">
                            </p>

                            @if ($errors->has('name'))
                            <p class="help is-danger">{{ $errors->first('name') }}</p>
                            @endif

                            <label class="label">Email</label>
                            <p class="control">
                                <input class="input {{ $errors->has('email') ? 'is-danger' : '' }}" type="text" placeholder="john@exmple.com" name="email" value="{{ old('email') }}" required>
                            </p>
                            @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                            <hr>
                            <label class="label">Password</label>
                            <p class="control">
                                <input class="input {{ $errors->has('password') ? 'is-danger' : '' }}" type="password" name="password" required>
                            </p>
                            @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif
                            <label class="label">Confirm Password</label>
                            <p class="control">
                                <input class="input" type="password" name="password_confirmation" required>
                            </p>
                            <hr>
                            <p class="control">
                                <button type="submit" class="button is-primary">Register</button>
                            </p>
                        </form>
                    </div>
                    <p class="has-text-centered">
                        <a href="/login">Login</a>
                        |
                        <a href="/help">Need help?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
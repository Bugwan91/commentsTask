@extends('layouts.default')

@section('content')
    <div class="content card container-card_center">
        <h3 class="title">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="field">
                <label for="email" class="label">E-Mail Address</label>

                <div class="control has-icons-left">
                    <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    @if ($errors->has('email'))
                        <span class="help is-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="field">
                <label for="password" class="label">Password</label>

                <div class="control">
                    <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help is-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <label>
                        <input type="checkbox" name="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        Login
                    </button>
                </div>
                <div class="control">
                    <a class="" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

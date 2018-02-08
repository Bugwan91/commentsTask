@extends('layouts.default')

@section('content')
    <div class="content card container-card_center">
        <h3 class="title">Reset Password</h3>
        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

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
                <label for="password-confirm" class="label">Confirm Password</label>

                <div class="control">
                    <input id="password-confirm" type="password" class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" required>
                </div>
            </div>


            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        Reset Password
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

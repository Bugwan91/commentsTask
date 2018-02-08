@extends('layouts.default')

@section('content')
    <div class="content card container-card_center">
        <h3 class="title">Reset Password</h3>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
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
                <div class="control">
                    <button type="submit" class="button is-primary">
                        Send Password Reset Link
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

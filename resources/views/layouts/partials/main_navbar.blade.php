<nav class="navbar container" role="navigation" aria-label="main navigation">
    <div class="navbar-menu is-active">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ route('home') }}">
                Home
            </a>
        </div>
        @if(!in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset']))
            <div id="auth" class="navbar-end">
                <auth :user-data="{{ Auth::user() ? Auth::user()->toJson() : '{}' }}"></auth>
            </div>
        @endif
    </div>

</nav>
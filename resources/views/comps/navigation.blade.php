<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Avity</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app') }}">Studio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('list-identicons') }}">Identicons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                </li>

                @if (Auth::user()->type === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('upgrades') }}">
                            <strong>Upgrade Requests</strong>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login-form') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('registration-form') }}">Register</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

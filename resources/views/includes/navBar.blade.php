<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Befit</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/information">Information</a>
            </li>
        </ul>
        @guest
        <span class="navbar-text">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </span>
        <span class="navbar-text">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </span>
        @endguest
    </div>
</nav>
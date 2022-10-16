<body>
<link rel="stylesheet" type="text/css" href="{{ asset('css/navBar.css') }}">
</body>
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
        @auth
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::User()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/user/{{ Auth::User()->id }}">My Account</a>
                <a class="dropdown-item" href="/user/{{ Auth::User()->id }}/edit">Edit Account</a>
                <a class="dropdown-item" href="/settings">Settings</a>
                <a class="dropdown-item" href="/logout">Logout</a>
            </div>
        </div>
        @endauth
    </div>
</nav>
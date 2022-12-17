<body>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navBar.css') }}">
</body>
<nav class="navbar navbar-expand-sm navbar-light bg-danger">
    <a class="navbar-brand text-light" href="/"><span style="font-weight: bold">Befit</span>Plans</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="/information">Information</a>
            </li>
        </ul>
        <div class="navbar-desktop">
            @guest
            <span class="navbar-text">
                <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
            </span>
            <span class="navbar-text">
                <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
            </span>
            @endguest
            @auth
            <div class="dropdown">
                <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/user/{{ Auth::User()->id }}">My Plans</a>
                    <a class="dropdown-item" href="/user/{{ Auth::User()->id }}/edit">Edit Account</a>
                    <a class="dropdown-item" href="/settings">Settings</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </div>
            @endauth
        </div>
        <div class="navbar-mobile">
            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link text-light" href="/user/{{ Auth::User()->id }}">My Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/user/{{ Auth::User()->id }}/edit">Edit Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/settings">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/logout">Logout</a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homePage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Befit</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Information</a>
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
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-6">
                <h2 class="d-flex justify-content-center">Choose your category</h2>
                <br></br>
                <ul class="list-group d-flex justify-content-center">
                    @guest
                    <a class="list-group-item" href="{{ route('register') }}">Upper Body</a>
                    <a class="list-group-item" href="{{ route('register') }}">Legs</a>
                    <a class="list-group-item" href="{{ route('register') }}">Cardio</a>
                    @endguest
                    @auth
                    <a class="list-group-item" data-toggle="modal" data-target="#exampleModalCenter">Upper Body</a>
                    <a class="list-group-item" data-toggle="modal" data-target="#exampleModalCenter">Legs</a>
                    <a class="list-group-item" data-toggle="modal" data-target="#exampleModalCenter">Cardio</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Choose your plan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <a class="list-group-item" href="/plan">Default Plan</a>
                                <a class="list-group-item" href="/plan">Personalized Plan</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endauth
                </ul>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>

</html>
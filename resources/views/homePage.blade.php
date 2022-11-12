<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homePage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                <h2 class="d-flex justify-content-center home-page-heading">Choose your category</h2>
                <br></br>
                <ul class="list-group d-flex justify-content-center">
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#upperBodyModalCenter">Upper Body</a>
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#lowerBodyModalCenter">Lower Body</a>
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#cardioModalCenter">Cardio</a>
                </ul>
            </div>
            <div class="modal fade" id="upperBodyModalCenter" tabindex="-1" role="dialog" aria-labelledby="upperBodyModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Choose your plan for upper body</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a class="list-group-item mt-3" method="POST" href="/storeDefaultPlan/1">Default Plan</a>
                            <a class="list-group-item mt-3" method="POST" href="/storePersonalizedPlan/1">Personalized Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="lowerBodyModalCenter" tabindex="-1" role="dialog" aria-labelledby="lowerBodyModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Choose your plan for lower body</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a class="list-group-item mt-3" method="POST" href="/storeDefaultPlan/2">Default Plan</a>
                            <a class="list-group-item mt-3" method="POST" href="/storePersonalizedPlan/2">Personalized Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cardioModalCenter" tabindex="-1" role="dialog" aria-labelledby="cardioModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger">Choose your plan for cardio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a class="list-group-item mt-3" method="POST" href="/storeDefaultPlan/3">Default Plan</a>
                            <a class="list-group-item mt-3" method="POST" href="/storePersonalizedPlan/3">Personalized Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
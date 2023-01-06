<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homePage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @if (Cookie::get('theme') == "dark")
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common-darkTheme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/homePage-darkTheme.css') }}">
    @endif
</head>

<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10 mb-5">
                <h2 class="d-flex justify-content-center home-page-heading"><span style="font-weight: bold">Befit</span>Plans</h2>
                <h3 class="d-flex home-page-info">The one place for both new and experienced to get, create and share their fitness plans</h3>
                <h2 class="d-flex justify-content-center home-page-second-heading">Choose your Plan</h2>
                <ul class="list-group d-flex justify-content-center text-center">
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#upperBodyModalCenter">Upper Body</a>
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#lowerBodyModalCenter">Lower Body</a>
                    <a class="list-group-item mt-3" data-toggle="modal" data-target="#cardioModalCenter">Cardio</a>
                    <a class="list-group-item mt-3" method="POST" href="/plan/create">Custom</a>
                </ul>
            </div>
            <div class="modal fade" id="upperBodyModalCenter" tabindex="-1" role="dialog" aria-labelledby="upperBodyModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-danger">Choose your plan for upper body</h3>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="workout-form mt-3" action="{{ action([App\Http\Controllers\PlanController::class, 'storePlan']) }}">
                                @csrf
                                <div class="btn-group" role="group">
                                    <input class="list-group-item mt-3 btn-default-plan" type="submit" name="plan_type" value="Default" />
                                    <input class="list-group-item mt-3 btn-personalized-plan" type="submit" name="plan_type" value="Personalized" />
                                </div>
                                <a data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse" class="collapse-link text-danger float-right">
                                    Advanced
                                </a>
                                <div id="collapse" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="select-equipment">Select which equipment you have:</p>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="pullUpBarUB" name="pullUpBar">
                                            <label class="custom-control-label text-danger" for="pullUpBarUB">Pull-up bar</label>
                                        </div>
                                        <div class="custom-control custom-checkbox mt-1">
                                            <input type="checkbox" class="custom-control-input" id="dumbbellsUB" name="dumbbells">
                                            <label class="custom-control-label text-danger" for="dumbbellsUB">Dumbbells</label>
                                        </div>
                                    </div>
                                </div>
                                <input name="category_id" hidden="true" value="1">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="lowerBodyModalCenter" tabindex="-1" role="dialog" aria-labelledby="lowerBodyModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-danger">Choose your plan for lower body</h3>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="workout-form mt-3" action="{{ action([App\Http\Controllers\PlanController::class, 'storePlan']) }}">
                                @csrf
                                <div class="btn-group" role="group">
                                    <input class="list-group-item mt-3 btn-default-plan" type="submit" name="plan_type" value="Default" />
                                    <input class="list-group-item mt-3 btn-personalized-plan" type="submit" name="plan_type" value="Personalized" />
                                </div>
                                <a data-toggle="collapse" id="lower-body-collapse" data-target="#collapseLB" aria-expanded="true" aria-controls="collapse" class="collapse-link text-danger float-right">
                                    Advanced
                                </a>
                                <div id="collapseLB" class="collapse" data-parent="#lower-body-collapse">
                                    <div class="card-body">
                                        <p class="select-equipment">Select which equipment you have:</p>
                                        <div class="custom-control custom-checkbox mt-1">
                                            <input type="checkbox" class="custom-control-input" id="dumbbellsLB" name="dumbbells">
                                            <label class="custom-control-label text-danger" for="dumbbellsLB">Dumbbells</label>
                                        </div>
                                    </div>
                                </div>
                                <input name="category_id" hidden="true" value="2">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cardioModalCenter" tabindex="-1" role="dialog" aria-labelledby="cardioModalCenter" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-danger">Choose your plan for cardio</h3>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="workout-form mt-3" action="{{ action([App\Http\Controllers\PlanController::class, 'storePlan']) }}">
                                @csrf
                                <div class="btn-group" role="group">
                                    <input class="list-group-item mt-3 btn-default-plan" type="submit" name="plan_type" value="Default" />
                                    <input class="list-group-item mt-3 btn-personalized-plan" type="submit" name="plan_type" value="Personalized" />
                                </div>
                                <input name="category_id" hidden="true" value="3">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
        @include('includes.footer')
        @include('includes.alerts')
</body>

</html>
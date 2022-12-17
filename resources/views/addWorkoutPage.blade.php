<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans - add workout</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/addWorkoutPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/popovers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    @include('includes.navBar')
    <h1 class="d-flex justify-content-center mt-5 mb-3">Add Workout</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-outline-danger mt-3 float-right bg-danger text-light back-to-plan-btn" href="/plan/{{$planId}}">Back to plan</a>
            </div>
            <div class="col-md-8">
                <form method="POST" class="workout-form mt-3" action="{{ action([App\Http\Controllers\WorkoutController::class, 'store'], $planId) }}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name *</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputName" value="{{ old('name') }}">
                            @error('name')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-2 col-form-label">Decription</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="description" class="form-control text-area" id="inputDescription" rows="2">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="day" class="col-sm-2 col-form-label" for="day">Day *</label>
                        <div class="col-sm-10">
                            <input min="1" max="28" type="number" name="day" id="day" class="form-control" value="{{ old('day') }}" />
                            @error('day')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-middle pt-1 form-radio-row">
                        <label class="col-sm-2 col-form-label">Day Off
                        <div class="custom-control custom-radio custom-control-inline mt-2 col-1 radio-first-button">
                            <input type="radio" id="day_off" class="custom-control-input" name="is_day_off" value="0" checked="checked">
                            <label class="custom-control-label" for="day_off">False</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline mt-2 col-1 ml-4">
                            <input type="radio" id="day_off_checked" class="custom-control-input" name="is_day_off" value="1">
                            <label class="custom-control-label active" for="day_off_checked">True</label>
                        </div>
                        </label>
                    </div>
                    <input type="submit" class="float-right btn btn-outline-danger mt-3 bg-danger text-light submit-btn" value="ADD WORKOUT"></input>
                </form>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
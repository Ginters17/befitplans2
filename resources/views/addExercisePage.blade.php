<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - add exercise</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/addExercisePage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/common.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/radio.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popovers.js') }}"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    @include('includes.navBar')
    <h1 class="d-flex justify-content-center mt-5 mb-5">Add Exercise</h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="btn btn-outline-danger float-right bg-danger text-light" href="/plan/{{$planId}}/workout/{{$workoutId}}">Back to workout</a>
            </div>
            <div class="col-6">
                <form method="POST" class="exercise-form" action="{{ action([App\Http\Controllers\ExerciseController::class, 'store'], $workoutId) }}">
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
                            <textarea type="text" name="description" class="form-control text-area" id="inputDescription" rows="2" value="">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row video-row">
                        <div class="col-sm-2 label-with-info-icon">
                            <label for="video_url" class="col-form-label">Video URL</label>
                            <i tabindex="0" class="align-top text-dark fa fa-info-circle" role="button" data-toggle="popover" data-trigger="focus" title="Video URL" data-content="URL must be from youtube and in format: https://www.youtube.com/watch?v=video-id"></i>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="video_url" class="form-control" id="inputExerciseVideoURL" value="">
                            @error('video_url')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reps" class="col-sm-2 col-form-label">Reps</label>
                        <div class="col-sm-10">
                            <input min="0" max="1000" type="number" name="reps" id="reps" class="form-control" value="{{ old('sets') }}" />
                            @error('reps')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sets" class="col-sm-2 col-form-label">Sets</label>
                        <div class="col-sm-10">
                            <input min="0" max="1000" type="number" name="sets" id="sets" class="form-control" value="{{ old('reps') }}" />
                            @error('sets')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="duration" class="col-sm-2 col-form-label">Duration</label>
                        <div class="col-sm-10">
                            <input min="0" id="inputDuration" max="10000" type="number" name="duration" id="duration" class="form-control" onkeyup="showDurationTypeRadio()" value="{{ old('duration') }}" />
                            @error('duration')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input name="duration_type" hidden="true" value="-1" checked="true">
                    <div class="form-group row align-middle pt-1 duration-type-radio" style="display:none">
                        <label class="col-sm-2 col-form-label">Duration type</label>
                        <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                            <input type="radio" id="seconds" class="custom-control-input" name="duration_type" value="1">
                            <label class="custom-control-label" for="seconds">Seconds</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                            <input type="radio" id="minutes" class="custom-control-input" name="duration_type" value="2">
                            <label class="custom-control-label active" for="minutes">Minutes</label>
                        </div>
                    </div>
                    <input type="submit" class="float-right btn btn-outline-danger bg-danger text-light add-exercise-button" value="ADD EXERCISE"></input>
                </form>
            </div>
            <div class="col">
                @include('includes.toTopButton')
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
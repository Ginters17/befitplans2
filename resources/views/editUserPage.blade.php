<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans - Edit my account</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/editUserPage.css') }}">
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
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <h1 class="d-flex justify-content-center mt-5 mb-5">Edit Account</h1>
                <form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'update'], $user->id) }}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Name*</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputPassworzd" value="{{$user->name}}">
                            @error('name')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Age</label>
                        <div class="col-sm-10">
                            <input min="1" type="number" name="age" class="form-control" id="inputPassworzd" value="{{$user->age}}">
                            @error('age')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Height (cm)</label>
                        <div class="col-sm-10">
                            <input min="1" type="number" name="height" class="form-control" id="inputPassworzd" value="{{$user->height}}">
                        </div>
                        @error('height')
                        <p class="alert alert-danger" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Weight (kg)</label>
                        <div class="col-sm-10">
                            <input min="1" type="number" name="weight" class="form-control" id="inputPassworzd" value="{{$user->weight}}">
                        </div>
                        @error('weight')
                        <p class="alert alert-danger" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row tests">
                        <label for="inputSex" class="col-sm-2 col-form-label">Sex</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sex">
                                <option selected disabled></option>
                                @if($user->sex == 1)
                                <option value="1" selected>Male</option>
                                @else
                                <option value="1">Male</option>
                                @endif
                                @if($user->sex == 2)
                                <option value="2" selected>Female</option>
                                @else
                                <option value="2">Female</option>
                                @endif
                                @if($user->sex == 3)
                                <option value="3" selected>Other</option>
                                @else
                                <option value="3">Other</option>
                                @endif
                                @if($user->sex == 4)
                                <option value="4" selected>Prefer not to say</option>
                                @else
                                <option value="4">Prefer not to say</option>
                                @endif
                            </select>
                        </div>
                        @error('sex')
                        <p class="alert alert-danger" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" class="float-right btn btn-danger btn-outline-danger mt-3 bg-danger text-light submit-btn" value="SAVE"></input>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
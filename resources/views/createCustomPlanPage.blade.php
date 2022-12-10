<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - create custom plan</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/createCustomPlanPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/popovers.js') }}"></script>

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
            <div class="col">
            </div>
            <div class="col-6">
                <h1 class="d-flex justify-content-center mt-5 mb-3">Create your own custom plan</h1>
                <div class="mb-3 help-box">
                    <p class="help-text">First things first, let us know some basic things about the plan like: name, description, length and visibility of your plan.</p>
                </div>
                <form method="POST" class="plan-form" action="{{ action([App\Http\Controllers\PlanController::class, 'storeCustomPlan']) }}">
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
                        <label for="inputDays" class="col-sm-2 col-form-label" for="typeNumber">Days *</label>
                        <div class="col-sm-10">
                            <input min="1" max="28" type="number" name="days" id="typeDays" class="form-control" />
                            @error('days')
                            <p class="alert alert-danger" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-middle pt-1">
                        <label class="col-sm-2 col-form-label">Visibility</label>
                        <i tabindex="0" class="align-middle text-danger fa fa-info-circle" role="button" data-toggle="popover" data-trigger="focus" title="Visibility" data-content="Private - only you can view this plan. Public - others can view and join this plan."></i>
                        <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                            <input type="radio" id="customRadioInline1" class="custom-control-input" name="is_public" value="0" checked="checked">
                            <label class="custom-control-label" for="customRadioInline1">Private</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                            <input type="radio" id="customRadioInline2" class="custom-control-input" name="is_public" value="1">
                            <label class="custom-control-label active" for="customRadioInline2">Public</label>
                        </div>
                    </div>
                    <input type="submit" class="float-right btn btn-outline-danger btn-open-modal mt-3 bg-danger text-light" value="CONTINUE"></input>
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
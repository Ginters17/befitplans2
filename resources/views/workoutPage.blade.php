<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - Workout</title>

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
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/plan/{{$plan->id}}">Back to {{ $plan->name }}</a>
            </div>
            <div class="col-6">
                <h2>Workout</h2>
                <p>{{$workout->name}}</p>
                <p>{{$workout->description}}</p>
                @foreach ($workout->exercise as $exercise)
                    <div class="list-group-item">
                        <p>{{$exercise->name}}</p>
                        @if($exercise->sets != null)
                            <p>Sets: {{$exercise->sets}}</p>
                        @endif
                        @if($exercise->reps != null)
                            <p>Reps: {{$exercise->reps}}</p>
                        @endif
                        @if($exercise->duration != null)
                            @if($plan->category_id == 3)
                            <p>Duration: {{$exercise->duration}} minutes</p>
                            @endif
                            @if($plan->category_id == 1 || $plan->category_id == 2)
                            <p>Duration: {{$exercise->duration}} seconds</p>
                            @endif
                        @endif
                    </div>
                @endforeach
                <a class="btn btn-light" href="{{$workout->id}}/complete">Complete Workout</a>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>

</html>
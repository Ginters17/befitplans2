<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans - {{$user->name}}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @if (Cookie::get('theme') == "dark")
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common-darkTheme.css') }}">
    @endif
</head>


<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                @if(auth()->user() && $user->id == auth()->user()->id)
                <h1 class="d-flex justify-content-center mt-5">My plans</h1>
                @else
                <h1 class="d-flex justify-content-center mt-5">{{$userName}} plans</h1>
                @endif
                @if (count($notCompletedUserPlans)>0)
                <h3 class="d-flex justify-content-left mt-2">In progress: </h3>
                @endif

                @foreach ($notCompletedUserPlans as $plan)
                <a class="list-group-item mt-3 bg-danger" href="/plan/{{$plan->id}}">{{ $plan->name }}</a>
                @endforeach
                @if (count($completedUserPlans)>0)
                <h3 class="d-flex justify-content-left mt-5">Completed: </h3>
                @endif
                @foreach ($completedUserPlans as $plan)
                <a class="list-group-item mt-3 bg-danger" href="/plan/{{$plan->id}}">{{ $plan->name }}</a>
                @endforeach
                @if (count($notCompletedUserPlans)==0 && count($completedUserPlans)==0)
                <h1 class="text-center mt-5">No Plans Found</h1>
                @endif

            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
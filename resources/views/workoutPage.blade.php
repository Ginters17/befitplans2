<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - Workout</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
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
    <h2 class="text-center mt-5">Workout</h2>
    <p class="text-center">{{$workout->name}}</p>
    <p class="text-center">{{$workout->description}}</p>
    <div class="container">
        <div class="row">
            <div class="col">
            <a class="btn btn-outline-danger mt-3 float-right" href="/plan/{{$plan->id}}">Back to plan</a>
            </div>
            <div class="col-6">
                @foreach ($workout->exercise as $exercise)
                <div class="list-group-item mt-3">
                    <p>{{$exercise->name}}</p>
                    @if($exercise->sets != null)
                    <p>Sets: {{$exercise->sets}}</p>
                    @endif
                    @if($exercise->reps != null)
                    <p>Reps: {{$exercise->reps}}</p>
                    @endif
                    @if($exercise->duration != null)
                    @if($plan->category_id == 3)
                    <p>Duration: {{$exercise->duration / 60}} minutes</p>
                    @endif
                    @if($plan->category_id == 1 || $plan->category_id == 2)
                    <p>Duration: {{$exercise->duration}} seconds</p>
                    @endif
                    @endif
                </div>
                @endforeach
                @if(!$workout->is_complete)
                <a class="btn btn-outline-danger mt-3 float-right" href="{{$workout->id}}/complete">Complete Workout</a>
                @endif
                @if($workout->is_complete)
                <h3 class="mt-3 float-right">Workout Completed</h3>
                @endif
            </div>
            <div class="col">
                @auth
                @if($workout->user_id == auth()->user()->id)
                @include('includes.editDeleteButtons')
                @endif
                @endauth
                @include('includes.toTopButton')
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal">Edit Workout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ action([App\Http\Controllers\WorkoutController::class, 'update'], $workout->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control ml-2" id="inputWorkoutName" value="{{$workout->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control ml-2" id="inputWorkoutDescription" value="{{$workout->description}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-danger">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal">Are you sure you want to delete this workout?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-primary btn-danger" method="POST" href="/plan/{{$plan->id}}/workout/{{$workout->id}}/delete">DELETE WORKOUT</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
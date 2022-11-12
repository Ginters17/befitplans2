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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/workoutPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/modal.js') }}"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    @include('includes.navBar')
    <h1 class="text-center mt-5">Workout</h1>
    <p class="text-center">{{$workout->name}}</p>
    <p class="text-center">{{$workout->description}}</p>
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="btn btn-outline-danger mt-3 float-right bg-danger text-light" href="/plan/{{$plan->id}}">Back to plan</a>
            </div>
            <div class="col-6">
                @foreach ($workout->exercise as $exercise)
                <div class="list-group-item mt-3 exercise-list-item bg-danger" href="workout/{{$workout->id}}/exercise/{{$exercise->id}}">
                    <div class="exercise-information">
                        <p>{{$exercise->name}}</p>
                        @if($exercise->sets != null)
                        <p>Sets: {{$exercise->sets}}</p>
                        @endif
                        @if($exercise->reps != null)
                        <p>Reps: {{$exercise->reps}}</p>
                        @endif
                        @if($exercise->duration != null)
                        <p>Duration: {{$exercise->duration}}</p>
                        @endif
                    </div>
                    @auth
                    @if($workout->user_id == auth()->user()->id)
                    <div class="float-right exercise-actions">
                        <button type="button" class="btn btn-outline-light btn-open-modal-no-text open-edit-modal" data-id="{{$exercise}}" data-toggle="modal" data-target="#editExerciseModal">
                            <i class="fa fa-gear"></i>
                        </button>
                        <button type="button" class="btn btn-outline-light btn-open-modal-no-text open-delete-modal" data-id="{{$exercise}}" data-toggle="modal" data-target="#deleteExerciseModal">
                            <i class="fa fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-outline-light btn-open-modal-no-text open-info-modal" data-id="{{$exercise}}" data-toggle="modal" data-target="#infoExerciseModal">
                            <i class="fa fa-info"></i>
                        </button>
                        @if(!$exercise->is_complete)
                        <a class="btn btn-outline-light btn-open-modal-no-text" href="{{$workout->id}}/exercise/{{$exercise->id}}/complete">
                            <i class="fa fa-check"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                    @endauth
                    @if($exercise->is_complete)

                    @endif
                </div>
                @endforeach
                @if(!$workout->is_complete && $areAllExercisesCompleted)
                <a class="btn btn-outline-danger mt-3 mb-3 bg-danger text-light float-right" href="{{$workout->id}}/complete">Complete Workout</a>
                @endif
                @if($workout->is_complete)
                <h3 class="mt-3 mb-3 float-right">Workout Completed</h3>
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

    <!-- Modals for the workout -->
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
                                <textarea name="description" class="ml-2 form-control" id="inputWorkoutDescription" rows="2">{{$workout->description}}</textarea>
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

    <!-- Modals for the exercise -->
    <div class="modal fade" id="deleteExerciseModal" tabindex="-1" role="dialog" aria-labelledby="deleteExerciseModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_delete_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-primary btn-danger delete-modal-href" method="POST" href="">DELETE EXERCISE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editExerciseModal" tabindex="-1" role="dialog" aria-labelledby="editExerciseModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_title">Edit Exercise</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-modal-form" method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control ml-2" id="inputExerciseName" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-2 form-control" id="inputExerciseDescription" rows="1"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sets" class="col-sm-2 col-form-label">Sets</label>
                            <div class="col-sm-10">
                                <input type="text" name="sets" class="form-control ml-2" id="inputExerciseSets" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reps" class="col-sm-2 col-form-label">Reps</label>
                            <div class="col-sm-10">
                                <input type="text" name="reps" class="form-control ml-2" id="inputExerciseReps" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="duration" class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="duration" class="form-control ml-2" id="inputExerciseDuration" value="">
                            </div>
                        </div>
                        <input type="hidden" name="exerciseId" class="form-control ml-2" id="hiddenExerciseId" value="">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-danger">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoExerciseModal" tabindex="-1" role="dialog" aria-labelledby="infoExerciseModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_info_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modal_info_description"></p>
                </div>
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
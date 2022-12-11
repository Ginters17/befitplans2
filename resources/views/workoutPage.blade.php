<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans - Workout</title>

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
    <script type="text/javascript" src="{{ asset('js/popovers.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/radio.js') }}"></script>

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
                        @if($exercise->duration_type == 1)
                        <p>Duration: {{$exercise->duration}} seconds</p>
                        @endif
                        @if($exercise->duration_type == 2)
                        <p>Duration: {{$exercise->duration}} minutes</p>
                        @endif
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
                        @if(!$exercise->is_complete && $areAllPreviousWorkoutsCompleted)
                        <a class="btn btn-outline-light btn-open-modal-no-text" href="{{$workout->id}}/exercise/{{$exercise->id}}/complete">
                            <i class="fa fa-check"></i>
                        </a>
                        @endif
                    </div>
                    @endif
                    @endauth
                </div>
                @endforeach
                @if (count($workout->exercise)==0 && !$workout->day_off)
                <h2 class="text-center mt-5 mb-5">No exercises found!</h2>
                @endif
                @if (count($workout->exercise)==0 && $workout->day_off)
                <h2 class="text-center mt-5 mb-5">It's your day off let's relax</h2>
                @endif
                @if($canAddExercise)
                <a class="list-group-item mt-3 bg-danger add-exercise-button text-center" href="{{$workout->id}}/add-exercise">ADD EXERCISE</a>
                @endif
                @if(!$workout->is_complete && $areAllExercisesCompleted && $areAllPreviousWorkoutsCompleted)
                <a class="btn btn-outline-danger mt-3 mb-3 bg-danger text-light float-right" href="{{$workout->id}}/complete">Complete Workout</a>
                @endif
                @if(auth()->user() && $workout->user_id == auth()->user()->id)
                @if($workout->is_complete)
                <h3 class="mt-3 mb-3 float-right">Workout Completed</h3>
                @endif
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
                                @error('name')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-2 form-control" id="inputWorkoutDescription" rows="2">{{$workout->description}}</textarea>
                                @error('description')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="day" class="col-sm-2 col-form-label">Day *</label>
                            <div class="col-sm-10">
                                <input min="1" max="28" type="number" name="day" id="day" class="form-control ml-2" value="{{$workout->day}}" />
                                @error('day')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
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
                                @error('name')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-2 form-control" id="inputExerciseDescription" rows="1"></textarea>
                                @error('description')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sets" class="col-sm-2 col-form-label">Sets</label>
                            <div class="col-sm-10">
                                <input type="text" name="sets" class="form-control ml-2" id="inputExerciseSets" value="">
                                @error('sets')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reps" class="col-sm-2 col-form-label">Reps</label>
                            <div class="col-sm-10">
                                <input type="text" name="reps" class="form-control ml-2" id="inputExerciseReps" value="">
                                @error('reps')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="duration" class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input min="0" id="inputDuration" max="10000" type="number" name="duration" id="duration" class="form-control ml-2" onkeyup="showDurationTypeRadio()" value="" />
                                @error('duration')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <input name="duration_type" hidden="true" value="-1" checked="true">
                        <div class="form-group row align-middle pt-1 duration-type-radio" style="display:none">
                            <label class="col-sm-2 col-form-label">Duration type</label>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                                <input type="radio" id="seconds" class="custom-control-input" name="duration_type" value="1" >
                                <label class="custom-control-label" for="seconds">Seconds</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                                <input type="radio" id="minutes" class="custom-control-input" name="duration_type" value="2" >
                                <label class="custom-control-label active" for="minutes">Minutes</label>
                            </div>
                        </div>
                        <div class="form-group row video-row">
                            <label for="video_url" class="col-sm-2 col-form-label">Video URL</label>
                            <i tabindex="0" class="col-sm-2 text-dark fa fa-info-circle" role="button" data-toggle="popover" data-trigger="focus" title="Video URL" data-content="URL must be from youtube and in format: https://www.youtube.com/watch?v=video-id"></i>
                            <div class="col-sm-8">
                                <input type="text" name="video_url" class="form-control ml-2" id="inputExerciseVideoURL" value="">
                                @error('video_url')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
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
                    <p id="modal_info_no_description"></p>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="testing123" class="embed-responsive-item" src="" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
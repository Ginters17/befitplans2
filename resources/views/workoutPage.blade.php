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
            <div class="col-md-2">
                <div class="back-to-plan-desktop float-right">
                    <a class="btn btn-outline-danger mt-3 bg-danger text-light" href="/plan/{{$plan->id}}">Back to plan</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="btn-group workout-actions-mobile" role="group">
                    <a class="btn btn-outline-danger mt-3 bg-danger text-light btn-back-to-plan" href="/plan/{{$plan->id}}">Back <span class="btn-back-to-plan-long">to plan</span></a>
                    @auth
                    @if($workout->user_id == auth()->user()->id)
                    @include('includes.editDeleteButtons')
                    @endif
                    @endauth
                    @include('includes.toTopButton')
                </div>
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
                        @if($exercise->is_complete && count($strava_activities) > 0)
                        <button type="button" class="btn btn-outline-light btn-open-modal-no-text open-add-activity-modal" data-id="{{$exercise}}" data-toggle="modal" data-target="#addActivityToExerciseModal">
                            <i class="fa fa-plus"></i>
                        </button>
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
            <div class="col-md-2">
                <div class="workout-actions-desktop">
                    @auth
                    @if($workout->user_id == auth()->user()->id)
                    @include('includes.editDeleteButtons')
                    @endif
                    @endauth
                    @include('includes.toTopButton')
                </div>
            </div>
        </div>
    </div>

    <!-- Modals for the workout -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="editModal">Edit Workout</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ action([App\Http\Controllers\WorkoutController::class, 'update'], $workout->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control ml-3" id="inputWorkoutName" value="{{$workout->name}}">
                                @error('name')
                                <p class="alert alert-danger ml-3" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-3 form-control" id="inputWorkoutDescription" rows="2">{{$workout->description}}</textarea>
                                @error('description')
                                <p class="alert alert-danger ml-3" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="day" class="col-sm-2 col-form-label">Day *</label>
                            <div class="col-sm-10">
                                <input min="1" max="28" type="number" name="day" id="day" class="form-control ml-3" value="{{$workout->day}}" />
                                @error('day')
                                <p class="alert alert-danger ml-3" role="alert">{{ $message }}</p>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModal">Are you sure you want to delete this workout?</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modal_delete_title"></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modal_edit_title">Edit Exercise</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-modal-form" method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control ml-5" id="inputExerciseName" value="">
                                @error('name')
                                <p class="alert alert-danger ml-5" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-5 form-control" id="inputExerciseDescription" rows="1"></textarea>
                                @error('description')
                                <p class="alert alert-danger ml-2" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sets" class="col-sm-2 col-form-label">Sets</label>
                            <div class="col-sm-10">
                                <input type="text" name="sets" class="form-control ml-5" id="inputExerciseSets" value="">
                                @error('sets')
                                <p class="alert alert-danger ml-5" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reps" class="col-sm-2 col-form-label">Reps</label>
                            <div class="col-sm-10">
                                <input type="text" name="reps" class="form-control ml-5" id="inputExerciseReps" value="">
                                @error('reps')
                                <p class="alert alert-danger ml-5" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="duration" class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input min="0" id="inputDuration" max="10000" type="number" name="duration" id="duration" class="form-control ml-5" onkeyup="showDurationTypeRadio()" value="" />
                                @error('duration')
                                <p class="alert alert-danger ml-5" role="alert">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <input name="duration_type" hidden="true" value="-1" checked="true">
                        <div class="form-group row align-middle pt-1 duration-type-radio form-radio-row" style="display:none">
                            <label class="col-sm-2 col-form-label">Units
                                <div class="custom-control custom-radio custom-control-inline mt-2 col-1 duration-seconds">
                                    <input type="radio" id="seconds" class="custom-control-input" name="duration_type" value="1">
                                    <label class="custom-control-label" for="seconds">Seconds</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mt-2 col-1 duration-minutes">
                                    <input type="radio" id="minutes" class="custom-control-input" name="duration_type" value="2">
                                    <label class="custom-control-label active" for="minutes">Minutes</label>
                                </div>
                            </label>
                        </div>
                        <div class="form-group row video-row">
                            <div class="col-sm-2 label-with-info-icon">
                                <label for="video_url" class="col-form-label">Video URL
                                    <i tabindex="0" class="align-top fa fa-info-circle text-danger" role="button" data-toggle="popover" data-trigger="hover" title="Video URL" data-content="URL must be from youtube and in format: https://www.youtube.com/watch?v=video-id"></i>
                                </label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="video_url" class="form-control ml-5" id="inputExerciseVideoURL" value="{{ old('video_url') }}">
                                @error('video_url')
                                <p class="alert alert-danger" role="alert">{{ $message }}</p>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modal_info_title"></h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
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
    <div class="modal fade" id="addActivityToExerciseModal" tabindex="-1" role="dialog" aria-labelledby="addActivityToExerciseModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Add your activity from Strava</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select one of these activities (Currently only supports runs)</p>
                    <select class="form-select col-sm-12">
                        <option selected disabled>Select</option>
                        @foreach ($strava_activities as $activity)
                        <option>{{$activity->name}} ({{$activity->start_date_local_short}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-danger">Add</button>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
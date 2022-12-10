<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - {{$plan->name}}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/planPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/popovers.js') }}"></script>
</head>

<body class="antialiased">
    @include('includes.navBar')
    <h1 class="text-center mt-5">{{$plan->name}}</h1>
    @if (count($planWorkouts)>0)
        <h3 class="text-center">Workouts for this plan:</h3>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6">
                @foreach ($planWorkouts as $workout)
                    @if(auth()->user() && $workout->user_id != auth()->user()->id)
                    <a class="bg-danger list-group-item mt-3" href="{{$workout->plan_id}}/workout/{{$workout->id}}">Day {{$workout->day}} - {{ $workout->name }}</a>
                    @else
                        @if($workout->is_complete)
                        <a class="bg-danger list-group-item mt-3" href="{{$workout->plan_id}}/workout/{{$workout->id}}">Day {{$workout->day}} - {{ $workout->name }}</a>
                        @else(!$workout->is_complete)
                        <a class="list-group-item mt-3" href="{{$workout->plan_id}}/workout/{{$workout->id}}">Day {{$workout->day}} - {{ $workout->name }}</a>
                        @endif
                    @endif
                @endforeach
                @if (count($planWorkouts)==0)
                    <h2 class="text-center mt-5 mb-5">No workouts found!</h2>
                @endif
                @if($canAddWorkout)
                    <a class="list-group-item mt-3 bg-danger text-center" href="{{$plan->id}}/add-workout">ADD WORKOUT</a>
                @endif
            </div>
            <div class="col-3">
                @auth
                @if($plan->is_public && auth()->user()->id != $plan->user_id)
                <button type="button" class="btn btn-outline-danger btn-open-modal mt-3 bg-danger text-light" data-toggle="modal" data-target="#joinModal">
                    <i class="fa fa-plus"></i>
                    Join
                </button>
                @endif
                @if($plan->user_id == auth()->user()->id)
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
                    <h5 class="modal-title" id="editModal">Edit Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ action([App\Http\Controllers\PlanController::class, 'update'], $plan->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name*</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control ml-2" id="inputPlanName" value="{{$plan->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="ml-2 form-control" id="inputPlanDescription" rows="2">{{$plan->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row align-middle pt-1">
                            <label class="col-sm-2 col-form-label">Visibility</label>
                            <i tabindex="0" class="align-middle text-dark fa fa-info-circle" role="button" data-toggle="popover" data-trigger="focus" title="Visibility" data-content="Private - only you can view this plan. Public - others can view and join this plan."></i>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                                @if ($plan->is_public == 0)
                                <input type="radio" id="customRadioInline1" class="custom-control-input" name="is_public" value="0" checked="checked">
                                @endif
                                @if ($plan->is_public != 0)
                                <input type="radio" id="customRadioInline1" class="custom-control-input" name="is_public" value="0">
                                @endif
                                <label class="custom-control-label" for="customRadioInline1">Private</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2 col-1">
                                @if ($plan->is_public == 1)
                                <input type="radio" id="customRadioInline2" class="custom-control-input" name="is_public" value="1" checked="checked">
                                @endif
                                @if ($plan->is_public != 1)
                                <input type="radio" id="customRadioInline2" class="custom-control-input" name="is_public" value="1">
                                @endif
                                <label class="custom-control-label active" for="customRadioInline2">Public</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-success">Save</button>
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
                    <h5 class="modal-title" id="deleteModal">Are you sure you want to delete this plan?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-primary btn-danger" method="POST" href="/plan/{{$plan->id}}/delete">DELETE PLAN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="joinModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinModal">Are you sure you want to join this plan?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-primary btn-danger" method="POST" href="/plan/{{$plan->id}}/join">JOIN PLAN</a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.alerts')
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Befit - {{$plan->name}}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/planPage.css') }}">
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
    <h1 class="text-center">{{$plan->name}}</h1>
    <h3 class="text-center">Workouts for this plan:</h3>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-6">
                @foreach ($planWorkouts as $workout)
                @if($workout->is_complete)
                <a class="list-group-item bg-success text-white" href="{{$workout->plan_id}}/workout/{{$workout->id}}">Day {{$workout->day}} - {{ $workout->name }}</a>
                @endif
                @if(!$workout->is_complete)
                <a class="list-group-item" href="{{$workout->plan_id}}/workout/{{$workout->id}}">Day {{$workout->day}} - {{ $workout->name }}</a>
                @endif
                @endforeach
            </div>
            <div class="col">
                @auth
                @if($plan->user_id == auth()->user()->id)
                <div class="plan-action-column">
                    <button type="button" class="btn btn-outline-danger btn-plan-page" data-toggle="modal" data-target="#editPlanModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear align-middle" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"></path>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"></path>
                        </svg>
                        Edit Plan
                    </button>
                    <br>
                    <button type="button" class="btn btn-outline-danger mt-1 btn-plan-page" data-toggle="modal" data-target="#deletePlanModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash align-middle" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                        Delete Plan
                    </button>
                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="editPlanModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlanModal">Edit Plan</h5>
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
                                <input type="text" name="description" class="form-control ml-2" id="inputPlanDescription" value="{{$plan->description}}">
                            </div>
                        </div>
                        <div class="form-group row align-middle pt-1">
                            <label class="col-sm-2 col-form-label">Visibility</label>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2">
                                @if ($plan->is_public == 0)
                                <input type="radio" id="customRadioInline1" class="custom-control-input" name="is_public" value="0" checked="checked">
                                @endif
                                @if ($plan->is_public != 0)
                                <input type="radio" id="customRadioInline1" class="custom-control-input" name="is_public" value="0">
                                @endif
                                <label class="custom-control-label" for="customRadioInline1">Private</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ml-4 mt-2">
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
    <div class="modal fade" id="deletePlanModal" tabindex="-1" role="dialog" aria-labelledby="deletePlanModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePlanModal">Are you sure you want to delete this plan?</h5>
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
    @if (session()->has('success'))
    <div class="alert alert-success fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
        <strong>Success!</strong> Plan has been updated successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @error('name')
    <div class="alert alert-danger fade show fixed-bottom mb-0 px-1 pl-3 pr-3" role="alert">
        <strong>Error!</strong> Plan not saved - Name must not be empty.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @enderror
</body>

</html>
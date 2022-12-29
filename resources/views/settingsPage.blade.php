<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans - settings</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/settingsPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @if (Cookie::get('theme') == "dark")
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common-darkTheme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/settingsPage-darkTheme.css') }}">
    @endif
</head>

<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h1 class="d-flex justify-content-center settings-header">Settings</h1>
                <p></p>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2>Strava</h2>
                        <hr>
                        <div class="settings-info">
                            <p>You can connect your Strava account with your BefitPlans account and add data from Strava activities to BefitPlans exercises. <span style="font-weight: bold">(Currently only supports runs for cardio plan)</span>
                            </p>
                        </div>
                        @if(!$strava_api_auhtorized)
                        <a href="http://www.strava.com/oauth/authorize?client_id=98338&response_type=code&redirect_uri=https://befitplans.com/auth&exchange_token&approval_prompt=force&scope=activity:read_all">
                            <img src="{{ asset('assets/images/btn_strava_connectwith_orange.png') }}" class="img-fluid" alt="Connect with Strava">
                        </a>
                        @else
                        <p class="already-connected-message">Already connected with Strava. You can revoke access to BefitPlans <a href="https://www.strava.com/settings/apps" target="_blank">here</a>.</p>
                        @endif
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Preferences</h2>
                        <hr>
                        <label class="col-sm-2 col-form-label form-radio-row text-danger">Theme
                            @if( Cookie::get('theme') == 'dark')
                            <div class="custom-control custom-radio custom-control-inline ml-3 mt-2 col-1 radio-first-button">
                                <input type="radio" onclick="window.location='/theme/light';" id="customRadioInline1" class="custom-control-input">
                                <label class="custom-control-label text-danger" for="customRadioInline1">Light</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ml-3 mt-2 col-1">
                                <a href="/theme/dark">
                                    <input type="radio" onclick="window.location='/theme/dark';" id="customRadioInline2" class="custom-control-input" checked="checked">
                                    <label class="custom-control-label text-danger" for="customRadioInline2">Dark</label>
                                </a>
                            </div>
                            @else
                            <div class="custom-control custom-radio custom-control-inline ml-3 mt-2 col-1 radio-first-button">
                                <input type="radio" onclick="window.location='/theme/light';" id="customRadioInline1" class="custom-control-input" checked="checked">
                                <label class="custom-control-label text-danger" for="customRadioInline1">Light</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline ml-3 mt-2 col-1">
                                <a href="/theme/dark">
                                    <input type="radio" onclick="window.location='/theme/dark';" id="customRadioInline2" class="custom-control-input">
                                    <label class="custom-control-label text-danger" for="customRadioInline2">Dark</label>
                                </a>
                            </div>
                            @endif
                        </label>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Account</h2>
                        <hr>
                        <a class="delete-account-link" data-toggle="modal" data-target="#deleteAccountModalCenter">Delete account</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    <!-- Delete account modal -->
    <div class="modal fade" id="deleteAccountModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Are you sure you want to delete your account?</h5>
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="warning-text">Your account will be deleted and you won't be able to restore it. All your plans will be deleted.</p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary btn-danger text-light" method="POST" href="/user/{{$user_id}}/delete">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
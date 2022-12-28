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
</head>

<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h1 class="d-flex justify-content-center settings-header">Settings</h1>
                <section class="strava-section">
                    <h2>Strava</h2>
                    <hr>
                    <div class="settings-info">
                        <p>You can connect your Strava account with your BefitPlans account and add data from Strava activities to BefitPlans exercises. <span style="font-weight: bold">(Currently only supports runs for cardio plan)</span>
                        </p>
                    </div>
                    @if(!$strava_api_auhtorized)
                    <a href="http://www.strava.com/oauth/authorize?client_id=98338&response_type=code&redirect_uri=https://befitplans.com/auth?exchange_token&approval_prompt=force&scope=activity:read_all">
                        <img src="{{ asset('assets/images/btn_strava_connectwith_orange.png') }}" class="img-fluid" alt="Connect with Strava">
                    </a>
                    @else
                    <p>Already connected with Strava. You can revoke access to BefitPlans <a href="https://www.strava.com/settings/apps" target="_blank">here</a>.</p>
                    @endif
                </section>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    @include('includes.footer')
    @include('includes.alerts')
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BefitPlans- information</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/informationPage.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @if (Cookie::get('theme') == "dark")
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common-darkTheme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/informationPage-darkTheme.css') }}">
    @endif
</head>

<body class="antialiased">
    @include('includes.navBar')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 mb-5">
                <h2 class="d-flex justify-content-center information-page-heading"><span style="font-weight: bold">Befit</span>Plans</h2>
                <h3 class="d-flex justify-content-center ">Information</h3>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2>What is BefitPlans</h2>
                        <hr>
                        <p>BefitPlans is a website for new and experienced to get, create, share their fitness plans. Currently we offer 3 automatically generated plans for you. By default each plan is 28 days long.
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>How to use BefitPlans</h2>
                        <hr>
                        <p>Once you are registered and logged in, you can choose one out of four plan categories in home page for fitness plan creation.</p>
                        <ol>
                            <li><span style="font-weight: bold">Upper Body</span> - a 28 day plan for your upper body muscles (Shoulders, Biceps, Triceps, Chest muscles, Back muscles, abs)</li>
                            <li><span style="font-weight: bold">Upper Body</span> - a 28 day plan for your upper body muscles (Shoulders, Biceps, Triceps, Chest muscles, Back muscles, abs)</li>
                            <li><span style="font-weight: bold">Upper Body</span> - a 28 day plan for your upper body muscles (Shoulders, Biceps, Triceps, Chest muscles, Back muscles, abs)</li>
                        </ol>
                        <p>When you have created a plan you can view it in 'My Plans'. Even an automatically generated plan is highly customizable with options to create, edit, delete workouts and exercises.</p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Frequently Asked Questions</h2>
                        <hr>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            How do you use my information to create a personalized plan?
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        We require your age, sex, weight and height in order to create a plan with exercises that are up to your abilities. If we got it wrong, you can always change reps and sets for exercise. Age, sex, weight and height isn't used anywhere else.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseRwo">
                                            How do you use my private Strava activites?
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Strava requires us to get your permission to read all your activities. The activities we get from Strava are used only so you can add them to an exercise. Your Strava activities aren't used anywhere else.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            How are the automatically plans generated? Who made them?
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Each plan will be the same whenever you choose one of the three automatically generated plans (Reps, sets and duration may change if you are using a personalized plan).
                                        The workouts and exercises in automatically genereated plans were made by Ginters Blauva, who has no qualifications in fitness or health, so you should customize them if you feel that's neccessary. 
                                        We recommend contacting a professional for more personal fitness plans and diet.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h2>Contact</h2>
                        <hr>
                        <p>Befitplans is a website created by <a href="https://www.linkedin.com/in/ginters-blauva-955b8022b/" target="_blank">Ginters Blauva</a>. You can contact him through this email: contact@befitplans.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
            </div>
        </div>
    </div>
</body>

</html>
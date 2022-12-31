<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Workout;
use App\Models\Exercise;
use App\Services\WorkoutService;
use App\Services\WorkoutCoefficientService;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    protected $workoutService;
    public function __construct(WorkoutService $workoutService, WorkoutCoefficientService $workoutCoefficientService)
    {
        $this->workoutService = $workoutService;
        $this->workoutCoefficientService = $workoutCoefficientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planId)
    {
        $plan = Plan::findOrFail($planId);
        $planWorkouts = Workout::where('plan_id', $planId)->orderBy('day', 'ASC')->get();

        if ($plan->is_public || auth()->user() && auth()->user()->id == $plan->user_id)
        {
            $canAddWorkout = $this->canWorkoutsBeAddedToPlan($plan);
            return view('planPage', compact('planWorkouts'), compact('plan'))->with('canAddWorkout', $canAddWorkout);
        }
        else
        {
            return redirect('/')->with('error', 'The Plan that you tried to view is set to private.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDefaultPlan(Request $request)
    {
        $this->validateLoggedIn("/register");

        $user = auth()->user();
        $previousPlanId = $this->findPreviousPlanId($request->category_id);
        if (!$previousPlanId)
        {
            $plan = new Plan();
            $plan->name = $this->getPlanName($user->name, $request->category_id);
            $plan->category_id = $request->category_id;
            $plan->user_id = auth()->id();
            $plan->is_default = 1;
            $plan->workouts = 28;
            $plan->save();

            $this->workoutService->makeWorkouts(1, auth()->user(), $plan, true);

            return redirect('/plan/' . $plan->id)->with('success', 'Plan has been created successfully.');
        }
        else
        {
            return back()->with('errorWithLink', ["You already have a plan in this category.", "Go to plan", "/plan/" . $previousPlanId]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePersonalizedPlan($cetegoryId)
    {
        $this->validateLoggedIn("/register");

        $previousPlanId = $this->findPreviousPlanId($cetegoryId);
        if (!$previousPlanId)
        {
            $user = auth()->user();

            if ($user->age == '' || $user->sex == null || $user->weight == null || $user->height == null)
            {
                return redirect('/user/' . $user->id . '/edit')->with('info', 'We need to know some details about you to create a personalized plan.');
            }

            $plan = new Plan();
            $plan->name = $this->getPlanName($user->name, $cetegoryId);
            $plan->category_id = $cetegoryId;
            $plan->user_id = auth()->id();
            $plan->is_default = 0;
            $plan->workouts = 28;
            $plan->save();

            /// Get coefficient for workout intensity and make workouts
            $coefficient = $this->workoutCoefficientService->getCoefficient(auth()->user());
            $this->workoutService->makeWorkouts($coefficient, auth()->user(), $plan, true);

            return redirect('/plan/' . $plan->id)->with('success', 'Plan has been created successfully.');
        }
        else
        {
            return back()->with('errorWithLink', ["You already have a plan in this category.", "Go to plan", "/plan/" . $previousPlanId]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $planId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'description' => 'max:300',
            'workouts' => 'required|min:0|max:28',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Workout not updated - one or more fields have an error");
        }

        $plan = Plan::findOrFail($planId);
        if (auth()->user() && $this->authorize('update', $plan))
        {
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->is_public = $request->is_public;
            $plan->workouts = $request->workouts;
            $plan->save();
            return back()->with('success', 'Plan has been updated successfully.');
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($planId)
    {
        $plan = Plan::findOrFail($planId);
        if (auth()->user() && $this->authorize('delete', $plan))
        {
            $plan->delete();
            return redirect('/')->with('success', 'Plan has been deleted successfully.');
        }
        else
        {
            return redirect('/');
        }
    }

    // Copies certain details from the given plan and creates a new plan for another user
    public function join($planId)
    {
        $validateLoggedIn =  $this->validateLoggedIn("/register");
        
        $plan = Plan::findOrFail($planId);

        if(!$plan->is_public){
            return back()->with('error', "This plan is private");
        }

        if (auth()->user() && $plan->user_id != auth()->user()->id)
        {
            $existingPlanId = $this->hasUserAlreadyJoinedPlan($plan, auth()->user()->id);
            if ($existingPlanId)
            {
                return back()->with('errorWithLink', ["You have already joined this plan.", "Go to plan.", "/plan/" . $existingPlanId]);
            }

            $user = auth()->user();
            $planId = $this->addPlanToUser($plan, $user);
            return redirect('plan/' . $planId)->with('success', 'Plan has been joined successfully.');
        }
        else
        {
            return back()->with('error', "You can't join your own plan.");
        }
    }

    // Returns view for user to create a custom plan
    public function createCustomPlan()
    {
        $this->validateLoggedIn("/register");
        return view('createCustomPlanPage');
    }

    // Stores a plan
    public function storeCustomPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'workouts' => 'required|min:0|max:28',
            'description' => 'max:300'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Plan not created - one or more fields have an error");
        }

        $validateLoggedIn =  $this->validateLoggedIn("/register");
        $validatePreviousPlan = $this->validatePreviousPlan(4, true);

        if ($validateLoggedIn == null && $validatePreviousPlan == null)
        {
            $plan = new Plan();
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->category_id = 4;
            $plan->user_id = auth()->user()->id;
            $plan->is_default = 0;
            $plan->is_custom = 1;
            $plan->is_public = $request->is_public;
            $plan->workouts = $request->workouts;
            $plan->save();

            return redirect('/plan/' . $plan->id . '/add-workout')->with('success', "Plan has been created successfully. Add your first workout!");
        }
    }

    // 
    public function validatePreviousPlan($cetegoryId, $customPlan = false)
    {
        $previousPlanId = $this->findPreviousPlanId($cetegoryId, $customPlan);
        if ($previousPlanId > 0)
        {
            $errorMessage = $customPlan ? "You already have a custom plan." : "You already have a plan in this category.";
            return redirect('/')->with('errorWithLink', [$errorMessage, "Go to plan", "/plan/" . $previousPlanId])->send();
        }
    }

    // Checks whether user already has plan in a category that they are trying to get a new plan in or already has a custom plan
    // Return Plan's id if one is found
    // Else return false
    private function findPreviousPlanId($cetegoryId, $customPlan = false)
    {
        $userId = auth()->user()->id;
        $userPlans = Plan::where('user_id', $userId)->get();

        foreach ($userPlans as $plan)
        {
            if ($plan->category_id == $cetegoryId)
            {
                return $plan->id;
            }
            elseif ($customPlan && $plan->is_custom)
            {
                return $plan->id;
            }
        }

        return false;
    }

    private function getPlanName($username, $category_id)
    {
        $planName = "";

        $planName .= $username[strlen($username) - 1] == "s" ? $username . "'" : $username . "'s";
        $categoryPart = "";
        switch ($category_id)
        {
            case 1:
                $categoryPart = "Upper Body";
                break;
            case 2:
                $categoryPart = "Lower Body";
                break;
            case 3:
                $categoryPart = "Cardio";
                break;
            case 4:
                $categoryPart = "Custom";
                break;
            default:
                $categoryPart = "";
        }
        $planName .= " ".$categoryPart." ";
        $planName .= "Plan";

        return strlen($planName) > 50 ? $categoryPart." Plan" : $planName;
    }

    private function addPlanToUser($plan, $user)
    {
        $newPlan = new Plan();
        $newPlan->name = $this->getPlanName($user->name, $plan->category_id);
        $newPlan->category_id = $plan->category_id;
        $newPlan->user_id = $user->id;
        $newPlan->is_default = $plan->is_default;
        $newPlan->original_plan_id = $plan->id;
        $newPlan->workouts = $plan->workouts;
        $newPlan->save();

        $planWorkouts = Workout::where('plan_id', $plan->id)->get();

        for ($i = 0; $i < sizeof($planWorkouts); $i++)
        {
            $newWorkout = new Workout();
            $newWorkout->name = $planWorkouts[$i]->name;
            $newWorkout->description = $planWorkouts[$i]->description;
            $newWorkout->plan_id = $newPlan->id;
            $newWorkout->user_id = $user->id;
            $newWorkout->day = $planWorkouts[$i]->day;
            $newWorkout->day_off = $planWorkouts[$i]->day_off;
            $newWorkout->save();

            $workoutExercises = Exercise::where('workout_id', $planWorkouts[$i]->id)->get();
            foreach ($workoutExercises as $exercise)
            {
                $newExercise = new Exercise();
                $newExercise->name = $exercise->name;
                $newExercise->description = $exercise->description;
                $newExercise->workout_id = $newWorkout->id;
                $newExercise->user_id = $user->id;
                $newExercise->reps = $exercise->reps;
                $newExercise->sets = $exercise->sets;
                $newExercise->duration = $exercise->sets;
                $newExercise->save();
            }
        }

        return $newPlan->id;
    }

    // Check if user has already joined this plan
    private function hasUserAlreadyJoinedPlan($plan, $userId)
    {
        $userPlans = Plan::where('user_id', $userId)->get();

        foreach ($userPlans as $userPlan)
        {
            if ($userPlan->original_plan_id == $plan->id)
            {
                return $userPlan->id;
            }
        }

        return false;
    }
}

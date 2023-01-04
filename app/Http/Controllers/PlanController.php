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
            $canCompletePlan = $this->canCompletePlan($plan);
            return view('planPage', compact('planWorkouts'), compact('plan'))
                ->with('canAddWorkout', $canAddWorkout)
                ->with('canCompletePlan', $canCompletePlan);
        }
        else
        {
            return redirect('/')->with('error', 'The Plan that you tried to view is set to private.');
        }
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
            'workouts' => 'required|min:1|max:28',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Plan not updated - one or more fields have an error");
        }

        if (!$this->canUpdateWorkoutCount($planId, $request->workouts))
        {
            return back()
                ->with("error", "Plan not updated - can't reduce to this nr. of workouts because there are more workouts than that already in this plan. You can delete them manually.");
        }

        $plan = Plan::findOrFail($planId);
        if (auth()->user() && $this->authorize('update', $plan))
        {
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->is_public = $request->is_public;
            if ($plan->workouts < $request->workouts)
            {
                $plan->is_complete = 0;
            }
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
        $this->validateLoggedIn("/register");

        $plan = Plan::findOrFail($planId);

        if (!$plan->is_public)
        {
            return back()->with('error', "This plan is private");
        }

        if ($plan->user_id != auth()->user()->id)
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

    // Stores a custom plan
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

    // Complete plan
    public function complete($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        if (auth()->user() && $this->authorize('complete', $plan))
        {
            if ($this->canCompletePlan($plan))
            {
                $plan->is_complete = true;
                $plan->save();
                return redirect('/plan/' . $plan_id)->with('success', 'Plan has been completed successfully.');
            }
            else
            {
                return back()->with("error", "Not all workouts are completed");
            }
        }
        else
        {
            return redirect('/');
        }
    }

    // Tries to find user's previous plan
    // Returns error message if it does
    private function validatePreviousPlan($cetegoryId, $customPlan = false)
    {
        $previousPlanId = $this->findPreviousPlanId($cetegoryId, $customPlan);
        if ($previousPlanId > 0)
        {
            $errorMessage = $customPlan ? "You already have a custom plan in progress." : "You already have a plan in progress in this category.";
            return redirect('/')->with('errorWithLink', [$errorMessage, "Go to plan", "/plan/" . $previousPlanId])->send();
        }
    }

    // Checks whether user already has a not completed plan in a category that they are trying to get a new plan in or already has a custom plan
    // Return Plan's id if one is found
    // Else return false
    private function findPreviousPlanId($cetegoryId, $customPlan = false)
    {
        $userId = auth()->user()->id;
        $userPlans = Plan::where('user_id', $userId)
            ->where(
                function ($query)
                {
                    $query->where('is_complete', '0')
                        ->orWhereNull('is_complete');
                }
            )->get();

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

    // Constructs and returns name for plan based on username and category
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
        $planName .= " " . $categoryPart . " ";
        $planName .= "Plan";

        return strlen($planName) > 50 ? $categoryPart . " Plan" : $planName;
    }

    // Adds given plan (and it's workouts and exercises) to given user
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

    // Checks if all workouts are completed in a plan
    private function canCompletePlan($plan)
    {
        if (auth()->user() && $plan->user_id == auth()->user()->id)
        {
            if ($plan->is_complete)
            {
                return false;
            }

            $workouts = Workout::where('plan_id', $plan->id)->get();
            if (sizeof($workouts) != $plan->workouts)
            {
                return false;
            }

            foreach ($workouts as $workout)
            {
                if (!$workout->is_complete)
                {
                    return false;
                }
            }
        }

        return true;
    }

    // Checks if number of workouts in plan is less than or equal to the number of workouts that user tried to reduce to
    private function canUpdateWorkoutCount($planId, $nrOfWorkouts)
    {
        $workouts = Workout::where('plan_id', $planId)->get();

        return sizeof($workouts) <= $nrOfWorkouts ? true : false;
    }
}

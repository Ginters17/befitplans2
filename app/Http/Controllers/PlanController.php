<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Workout;
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
        $planWorkouts = Workout::where('plan_id', $planId)->get();
        return view('planPage', compact('planWorkouts'), compact('plan'));
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
        if (auth()->user()) {
            $user = auth()->user();
            $previousPlanId = $this->findPreviousPlanId($request);
            if (!$previousPlanId) {
                $plan = new Plan();
                $plan->name = $this->getPlanName($user->name, $request);
                $plan->category_id = $request->category_id;
                $plan->user_id = auth()->id();
                $plan->is_default = 1;
                $plan->save();

                $this->workoutService->makeWorkouts(1, auth()->user(), $plan, true);

                return redirect('/plan/' . $plan->id)->with('success', 'Plan has been created successfully.');
            } else {
                return back()->with('errorWithLink', ["You already have a plan in this category.", "Go to plan", "/plan/".$previousPlanId]);
            }
        } else {
            return redirect('/register');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePersonalizedPlan(Request $request)
    {
        if (auth()->user()) {
            $previousPlanId = $this->findPreviousPlanId($request);
            if (!$previousPlanId) {
                $user = auth()->user();

                if ($user->age == '' || $user->sex == null || $user->weight == null || $user->height == null) {
                    return redirect('/user/' . $user->id . '/edit')->with('info', 'We need to know some details about you to create a personalized plan.');
                }

                $plan = new Plan();
                $plan->name = $this->getPlanName($user->name, $request);
                $plan->category_id = $request->category_id;
                $plan->user_id = auth()->id();
                $plan->is_default = 0;
                $plan->save();

                /// Get coefficient for workout intensity and make workouts
                $coefficient = $this->workoutCoefficientService->getCoefficient(auth()->user());
                $this->workoutService->makeWorkouts($coefficient, auth()->user(), $plan, true);

                return redirect('/plan/' . $plan->id)->with('success', 'Plan has been created successfully.');
            }
            else {
                return back()->with('errorWithLink', ["You already have a plan in this category.", "Go to plan", "/plan/".$previousPlanId]);
            }
        } else {
            return redirect('/register');
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
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Plan not updated - Name must not be empty.');
        }

        $plan = Plan::findOrFail($planId);
        if (auth()->user() && $this->authorize('update', $plan)) {
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->is_public = $request->is_public;
            $plan->save();
            return back()->with('success', 'Plan has been updated successfully.');
        } else {
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
        if (auth()->user() && $this->authorize('delete', $plan)) {
            $plan->delete();
            return redirect('/')->with('success', 'Plan has been deleted successfully.');
        } else {
            return redirect('/');
        }
    }

    // Checks whether user already has plan in a category that they are trying to get a new plan in
    // Return Plan's id if one is found
    // Else return false
    private function findPreviousPlanId($request)
    {
        $userId = auth()->user()->id;
        $userPlans = Plan::where('user_id', $userId)->get();

        foreach ($userPlans as $plan) {
            if ($plan->category_id == $request->category_id) {
                return $plan->id;
            }
        }

        return false;
    }

    private function getPlanName($username, $request){
        $planName = "";

        $planName .= $username[strlen($username)-1] == "s" ? $username."'" : $username."'s";
        switch ($request->category_id) {
            case 1:
              $planName .= " Upper Body ";
              break;
            case 2:
                $planName .= " Lower Body ";
              break;
            case 3:
                $planName .= " Cardio ";
              break;
            default:
                $planName .= " ";
          }
        $planName .= "Plan";

        return $planName;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\Workout;
use App\Services\WorkoutService;

class PlanController extends Controller
{
    protected $workoutService;
    public function __construct(WorkoutService $workoutService)
    { 
        $this->workoutService = $workoutService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planId)
    {
        $plan = Plan::findOrFail($planId);
        $planWorkouts=Workout::where('plan_id', $planId)->get();
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
        if (Auth::user()) {  
            $userName = auth()->user()->name;
            $plan = new Plan();
            $plan->name="{$userName}'s plan";
            $plan->category_id=$request->category_id;
            $plan->user_id=auth()->id();
            $plan->is_default=1;
            $plan->save();

            $this->workoutService->makeWorkouts(1, auth()->user(), $plan, true);
            
            return redirect('/plan/'.$plan->id);
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
        if (Auth::user()) {
            $user = auth()->user();  
            if($user->age == '' || $user->sex == null || $user->weight == null || $user->height == null)
            {
                return redirect('/user/'.$user->id.'/edit');
            } 
            $userName = auth()->user()->name;
            $plan = new Plan();
            $plan->name="{$userName}'s plan";
            $plan->category_id=$request->category_id;
            $plan->user_id=auth()->id();
            $plan->is_default=0;
            $plan->save();

            // Make and call service to get coefficient for workouts based on user's data
            $this->workoutService->makeWorkouts(1, auth()->user(), $plan, true);
            return redirect('/plan/'.$plan->id);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planId, $workoutId)
    {
        $workout = Workout::with(['exercise'])->findOrFail($workoutId);
        $plan = Plan::findOrFail($planId);
        $areAllPreviousWorkoutsCompleted = $this->areAllPreviousWorkoutsCompleted($plan->id, $workoutId);

        if (!$areAllPreviousWorkoutsCompleted) {
            return back()->with('error', "Previous workout isn't complete");
        }

        $areAllExercisesCompleted = $this->areAllExercisesCompleted($workout);
        return view('workoutPage', compact('workout'), compact('plan'))->with('areAllExercisesCompleted', $areAllExercisesCompleted);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $workoutId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Workout not updated - Name must not be empty.');
        }

        $workout = Workout::findOrFail($workoutId);
        if (auth()->user() && $this->authorize('update', $workout)) {
            $workout->name = $request->name;
            $workout->description = $request->description;
            $workout->save();
            return back()->with('success', 'Workout has been updated successfully.');
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
    public function destroy($planId, $workoutId)
    {
        $workout = Workout::findOrFail($workoutId);
        if (auth()->user() && $this->authorize('delete', $workout)) {
            $workout->delete();
            return redirect('/plan/' . $planId)->with('success', 'Workout has been deleted successfully.');
        } else {
            return redirect('/');
        }
    }

    public function complete($plan_id, $workout_id)
    {
        $workout = Workout::findOrFail($workout_id);
        if (auth()->user() && $this->authorize('complete', $workout)) {
            $workout->is_complete = true;
            $workout->save();
            return redirect('/plan/' . $plan_id)->with('success', 'Workout has been completed successfully.');
        } else {
            return redirect('/');
        }
    }

    private function areAllExercisesCompleted(Workout $workout)
    {
        foreach ($workout->exercise as $exercise) {
            if (!$exercise->is_complete) {
                return false;
            }
        }

        return true;
    }

    private function areAllPreviousWorkoutsCompleted($planId, $workoutId)
    {
        $planWorkouts = Workout::where('plan_id', $planId)->get();
        for ($i = 0; $planWorkouts[$i]->id < $workoutId; $i++) {
            if (!$planWorkouts[$i]->is_complete) {
                return false;
            }
        }

        return true;
    }
}

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
        $canAddExercise = $this->canExercisesBeAddedToWorkout($workout);
        $areAllExercisesCompleted = $this->areAllExercisesCompleted($workout);

        return view('workoutPage', compact('workout'), compact('plan'))
            ->with('canAddExercise', $canAddExercise)
            ->with('areAllPreviousWorkoutsCompleted', $areAllPreviousWorkoutsCompleted)
            ->with('areAllExercisesCompleted', $areAllExercisesCompleted);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($planId)
    {
        $this->validateLoggedIn("/register");

        $plan = Plan::findOrFail($planId);

        if ($this->authorize('addWorkout', $plan) && $this->canWorkoutsBeAddedToPlan($plan))
        {
            return view('addWorkoutPage')->with("planId", $plan->id)->with("success", "Plan created succesfully. Let's add your first workout!");
        }
        elseif ($this->authorize('addWorkout', $plan) && !$this->canWorkoutsBeAddedToPlan($plan))
        {
            return redirect('plan/' . $planId)->with("error", "No more workouts can be added to this plan.");
        }
        else
        {
            return redirect('/')->with("error", "Only the owner of the plan can add workouts to it.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $planId)
    {
        $validateLoggedIn = $this->validateLoggedIn("/register");

        if ($validateLoggedIn == null)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'day' => 'required|min:0|max:28',
                'description' => 'max:300'
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with("error", "Plan not created - one or more fields have an error");
            }

            $user = auth()->user();

            $workout = new Workout();
            $workout->plan_id = $planId;
            $workout->name = $request->name;
            $workout->description = $request->description;
            $workout->user_id = $user->id;
            $workout->day = $request->day;
            $workout->day_off = $request->is_day_off;
            $workout->save();

            if ($workout->day_off)
            {
                return redirect('/plan/' . $planId)->with('success', 'Workout has been added.');
            }
            else
            {
                return redirect('/plan/' . $planId . "/workout/" . $workout->id . "/add-exercise")->with('success', 'Workout has been added.');
            }
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
    public function update(Request $request, $workoutId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'max:300',
            'day' => 'required|min:1|max:28'
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Workout not updated - one or more fields have an error");
        }

        $workout = Workout::findOrFail($workoutId);
        if (auth()->user() && $this->authorize('update', $workout))
        {
            $workout->name = $request->name;
            $workout->description = $request->description;
            $workout->day = $request->day;
            $workout->save();
            return back()->with('success', 'Workout has been updated successfully.');
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
    public function destroy($planId, $workoutId)
    {
        $workout = Workout::findOrFail($workoutId);
        if (auth()->user() && $this->authorize('delete', $workout))
        {
            $workout->delete();
            return redirect('/plan/' . $planId)->with('success', 'Workout has been deleted successfully.');
        }
        else
        {
            return redirect('/');
        }
    }

    public function complete($plan_id, $workout_id)
    {
        $workout = Workout::findOrFail($workout_id);
        if (auth()->user() && $this->authorize('complete', $workout))
        {
            if ($this->areAllPreviousWorkoutsCompleted($plan_id, $workout_id) && $this->areAllExercisesCompleted($workout))
            {
                $workout->is_complete = true;
                $workout->save();
                return redirect('/plan/' . $plan_id)->with('success', 'Workout has been completed successfully.');
            }
            else {
                return back()->with("error","Previous workout or exercise isn't complete");
            }
        }
        else
        {
            return redirect('/');
        }
    }

    private function areAllExercisesCompleted(Workout $workout)
    {
        foreach ($workout->exercise as $exercise)
        {
            if (!$exercise->is_complete)
            {
                return false;
            }
        }

        return true;
    }

    private function areAllPreviousWorkoutsCompleted($planId, $workoutId)
    {
        $planWorkouts = Workout::where('plan_id', $planId)->orderby('day', 'ASC')->get();
        for ($i = 0; $planWorkouts[$i]->id < $workoutId; $i++)
        {
            if (!$planWorkouts[$i]->is_complete)
            {
                return false;
            }
        }

        return true;
    }
}

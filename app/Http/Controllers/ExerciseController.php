<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Workout;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planId, $exerciseId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($planId, $workoutId)
    {
        $validateLoggedIn =  $this->validateLoggedIn("/register");

        if ($validateLoggedIn == null)
        {
            $workout = Workout::findOrFail($workoutId);

            if ($this->authorize('addExercise', $workout) && $this->canExercisesBeAddedToWorkout($workout))
            {
                return view('addExercisePage')
                    ->with("workoutId", $workout->id)
                    ->with("planId", $workout->plan_id)
                    ->with("success", "Workout created succesfully. Let's add your first exercise!");
            }
            elseif ($this->authorize('addExercise', $workout) && !$this->canExercisesBeAddedToWorkout($workout))
            {
                return redirect('plan/' . $workoutId)->with("error", "No more exercises can be added to this workout.");
            }
            else
            {
                return redirect('/')->with("error", "Only the owner of the workout can add exercises to it.");
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $workoutId)
    {
        $validateLoggedIn = $this->validateLoggedIn("/register");

        if ($validateLoggedIn == null)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'max:300',
                'reps' => 'max:1000',
                'sets' => 'max:1000',
                'duration' => 'max:10000'
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with("error", "Plan not created - one or more fields have an error");
            }

            $user = auth()->user();

            $exercise = new Exercise();
            $exercise->workout_id = $workoutId;
            $exercise->name = $request->name;
            $exercise->description = $request->description;
            $exercise->user_id = $user->id;
            $exercise->reps = $request->reps;
            $exercise->sets = $request->sets;
            $exercise->duration = $request->duration;
            $exercise->duration_type = $request->duration_type;
            $exercise->save();

            $workout = Workout::findOrFail($workoutId);
            $workout->is_complete = 0;
            $workout->save();
            
            return redirect('/plan/' . $workout->plan_id . "/workout/" . $workoutId)->with('success', 'Exercise has been added');
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails())
        {
            return back()->with('error', 'Exercise not updated - Name must not be empty.');
        }

        $exercise = Exercise::findOrFail($request->exerciseId);
        if (auth()->user() && $this->authorize('update', $exercise))
        {
            $exercise->name = $request->name;
            $exercise->description = $request->description;
            $exercise->sets = $request->sets;
            $exercise->reps = $request->reps;
            $exercise->duration = $request->duration;
            $exercise->duration_type = $request->duration_type;
            $exercise->save();
            return back()->with('success', 'Exercise has been updated successfully.');
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
    public function destroy($planId, $workoutId, $exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        if (auth()->user() && $this->authorize('delete', $exercise))
        {
            $exercise->delete();
            return back()->with('success', 'Execercise has been deleted successfully.');
        }
        else
        {
            return redirect('/');
        }
    }

    public function complete($plan_id, $workout_id, $exercise_id)
    {
        $exercise = Exercise::findOrFail($exercise_id);
        if (auth()->user() && $this->authorize('complete', $exercise))
        {
            $exercise->is_complete = true;
            $exercise->save();
            return back()->with('success', 'Execercise has been completed successfully.');
        }
        else
        {
            return redirect('/');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Exercise not updated - Name must not be empty.');
        }

        $exercise = Exercise::findOrFail($request->exerciseId);
        if (auth()->user() && $this->authorize('update', $exercise)) {
            $exercise->name = $request->name;
            $exercise->description = $request->description;
            $exercise->sets = $request->sets;
            $exercise->reps = $request->reps;
            $exercise->duration = $request->duration;
            $exercise->save();
            return back()->with('success', 'Exercise has been updated successfully.');
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
    public function destroy($planId, $workoutId, $exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        if (auth()->user() && $this->authorize('delete', $exercise)) {
            $exercise->delete();
            return back()->with('success', 'Execercise has been deleted successfully.');
        } else {
            return redirect('/');
        }
    }

    public function complete($plan_id, $workout_id, $exercise_id)
    {
        $exercise = Exercise::findOrFail($exercise_id);
        if (auth()->user() && $this->authorize('complete', $exercise)) {
            $exercise->is_complete = true;
            $exercise->save();
            return back()->with('success', 'Execercise has been completed successfully.');
        } else {
            return redirect('/');
        }
    }
}

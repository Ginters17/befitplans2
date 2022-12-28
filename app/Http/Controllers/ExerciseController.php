<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Strava_activity;
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
                'reps' => 'nullable|integer|max:1000',
                'sets' => 'nullable|integer|max:1000',
                'duration' => 'nullable|integer|max:10000',
                'info_video_url' => 'max:255',
            ]);

            if ($validator->fails())
            {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with("error", "Exercise not created - one or more fields have an error");
            }

            if ($request->video_url != null && $this->checkIsValidVideoUrl($request->video_url) == 0)
            {
                return back()
                    ->withInput()
                    ->with("error", "Exercise not created - Video URL format is wrong");
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
            if ($exercise->duration > 0)
            {
                $exercise->duration_type = $request->duration_type;
            }
            $exercise->info_video_url = $request->video_url;
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
            'name' => 'required|max:100',
            'description' => 'max:1000',
            'reps' => 'nullable|integer',
            'sets' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'info_video_url' => 'max:255',
        ]);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Exercise not updated - one or more fields have an error");
        }

        if ($request->video_url != null && $this->checkIsValidVideoUrl($request->video_url) == 0)
        {
            return back()->with('error', "Exercise not updated - Video URL format is wrong");
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
            $exercise->info_video_url = $request->video_url;
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

    private function checkIsValidVideoUrl($videoUrl)
    {
        
        // Youtube id's are 11 characters long
        $actualUrlBeforeId = $newstring = substr($videoUrl, 0, strlen($videoUrl) - 11);
        $expectedUrlBeforeId = "https://www.youtube.com/watch?v=";
        $videoId = str_replace($actualUrlBeforeId, "", $videoUrl); // Remove VideoBeforeId from url

        if (strcmp($actualUrlBeforeId, $expectedUrlBeforeId) == 0 && strlen($videoId) == 11)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function addStravaActivity(Request $request)
    {
        $exercise = Exercise::findOrFail($request->exerciseId);
        $activity = Strava_activity::where('activity_id',$request->activityId)->get();
        

        if (auth()->user() && $this->authorize('update', $exercise))
        {
            $exercise->activity_id = $request->activity;
            $exercise->save();

            $activity[0]->exercise_id = $request->exerciseId;
            $activity[0]->save();

            return back()->with('success', 'Strava activity has been added sucessfully.');
        }
        else
        {
            return redirect('/');
        }
        
    }

    public function removeStravaActivity($planId, $workoutId, $exerciseId)
    {
        $exercise = Exercise::findOrFail($exerciseId);
        $activity = Strava_activity::where('exercise_id',$exerciseId)->get();
        if (auth()->user() && $this->authorize('delete', $exercise))
        {
            $exercise->activity_id = null;
            $exercise->save();
            $activity[0]->exercise_id = null;
            $activity[0]->save();
            return back()->with('success', 'Strava activity has been removed successfully.');
        }
        else
        {
            return redirect('/');
        }
    }
}

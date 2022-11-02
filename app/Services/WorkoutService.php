<?php

namespace App\Services;

use App\Models\Workout;
use App\Models\Exercise;

class WorkoutService
{
    public function makeWorkouts($coefficient, $user, $plan, $is_default)
    {
        if ($plan->category_id == 1) 
        {
            $this->makeUpperBodyWorkouts($coefficient, $user, $plan, $is_default);
        } 
        elseif ($plan->category_id == 2) 
        {
            $this->makeLowerBodyWorkouts($coefficient, $user, $plan, $is_default);
        }
        elseif ($plan->category_id == 3) 
        {
            $this->makeCardioWorkouts($coefficient, $user, $plan, $is_default);
        }
    }

    /// Make 28 workouts, make exercises for each workout
    private function makeCardioWorkouts($coefficient, $user, $plan,)
    {
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20*60, $coefficient);
       
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 3, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, null);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 7, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, null);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 11, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, null);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 15, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 19, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 23, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 50*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 55*60, $coefficient);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 27, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 55*60, $coefficient);
        
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 60*60, $coefficient);
    }

    private function makeUpperBodyWorkouts($coefficient, $user, $plan,)
    {
        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 6, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 6, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 60, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 12, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 3, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 12, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 6, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 8, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 8, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 70, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 14, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 7, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 14, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 8, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 9, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 9, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 75, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 15, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 11, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 15, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 9, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 10, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 10, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 80, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 16, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 15, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 16, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 10, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 11, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 11, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 85, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 17, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 19, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 17, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 11, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 12, 3, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 12, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 90, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 18, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 23, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 18, 3, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 12, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 10, 4, null, $coefficient);
        $this->makeExercise("Tricep Dips", "Do tricep Dips", $workout_id, $user->id, 10, 4, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("Planks", "Do planks", $workout_id, $user->id, null, null, 90, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 14, 4, null, $coefficient);

        $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 27, 0, $coefficient);
        $this->makeExercise("Superman", "Do Superman", $workout_id, $user->id, 14, 4, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 10, 4, null, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups, Diamond push ups, Crunches", "Regular push ups will work your chest and triceps. Diamond push ups will work your biceps. Crunches will work your abs.", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("Regular push ups", "Do regular push ups", $workout_id, $user->id, 12, 4, null, $coefficient);
        $this->makeExercise("Diamond push ups", "Do diamond push ups", $workout_id, $user->id, 12, 4, null, $coefficient);
        $this->makeExercise("Crunches", "Do crunches", $workout_id, $user->id, 16, 4, null, $coefficient);
        
    
    }

    private function makeLowerBodyWorkouts($coefficient, $user, $plan, $is_default)
    {
        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 6, 3, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 6, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 6, 3, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 6, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 3, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 6, 3, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 6, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 7, 3, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 7, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 7, 3, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 7, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 7, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 7, 3, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 7, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 8, 3, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 8, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 8, 3, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 8, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 11, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 8, 3, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 8, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 9, 3, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 9, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 9, 3, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 9, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 15, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 9, 3, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 9, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 10, 3, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 10, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 10, 3, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 10, 3, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 19, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 10, 3, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 10, 3, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 8, 4, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 8, 4, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 23, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 8, 4, null, $coefficient);

        $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 9, 4, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 9, 4, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("Regular squats", "Do regular squats", $workout_id, $user->id, 9, 4, null, $coefficient);
        $this->makeExercise("Bulgarian split squat", "Do bulgarian split squat", $workout_id, $user->id, 9, 4, null, $coefficient);
        
        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 27, 0, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 9, 4, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 9, 4, null, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats, Glute Bridges and Squat Jumps", "These exercises will work Glutes, Quads, Hamstrings and Calves", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("Regular Regular squats", "Do regular squats", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Sumo squats", "Do sumo squats", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Glute Bridges", "Do glute bridges", $workout_id, $user->id, 8, 4, null, $coefficient);
        $this->makeExercise("Squat Jumps", "Do squat jumps", $workout_id, $user->id, 9, 4, null, $coefficient);
    }

    private function makeWorkout($name, $description, $plan_id, $user_id, $day, $day_off, $coefficient)
    {
        $workout = new Workout();
        $workout->name = $name;
        $workout->description = $description;
        $workout->plan_id = $plan_id;
        $workout->user_id = $user_id;
        $workout->day = $day;
        $workout->day_off = $day_off;
        $workout->save();

        return $workout->id;
    }

    private function makeExercise($name, $description, $workout_id, $user_id, $reps, $sets, $duration,  $coefficient)
    {
        $exercise = new Exercise();
        $exercise->name = $name;
        $exercise->description = $description;
        $exercise->workout_id = $workout_id;
        $exercise->user_id = $user_id;
        $exercise->reps = ceil($reps * $coefficient);
        $exercise->sets = ceil($sets * $coefficient);
        $exercise->duration = $duration * $coefficient;
        $exercise->save();
    }
}
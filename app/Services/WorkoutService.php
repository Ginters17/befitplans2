<?php

namespace App\Services;

use App\Models\Workout;
use App\Models\Exercise;

class WorkoutService
{
    private bool $hasPullUpBar;
    private bool $hasDumbbells;

    public function makeWorkouts($coefficient, $user, $plan, $equipment)
    {
        $this->hasPullUpBar = $equipment[0];
        $this->hasDumbbells = $equipment[1];

        if ($plan->category_id == 1)
        {
            $this->makeUpperBodyWorkouts($coefficient, $user, $plan);
        }
        elseif ($plan->category_id == 2)
        {
            $this->makeLowerBodyWorkouts($coefficient, $user, $plan);
        }
        elseif ($plan->category_id == 3)
        {
            $this->makeCardioWorkouts($coefficient, $user, $plan);
        }
    }

    /// Make 28 workouts, make exercises for each workout
    private function makeCardioWorkouts($coefficient, $user, $plan)
    {
        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 3, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 20, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 7, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 25, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 11, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 30, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 15, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 35, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 19, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 40, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 23, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 45, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, null);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 50, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 55, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 27, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 55, $coefficient, 2);

        $workout_id = $workout_id = $this->makeWorkout("RUN", "Run inside or outdoors", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("RUN", "Run inside or outdoors", $workout_id, $user->id, null, null, 60, $coefficient, 2);
    }

    private function makeUpperBodyWorkouts($coefficient, $user, $plan)
    {
        // Descriptions
        $regularPushUps_description = "Perform push-ups by holding yourself in a high plank position with your hands slightly wider than shoulder-width apart on the floor. While keeping your back and legs in a straight line, lower your body toward the floor, then push back up to the starting position.";
        $tricepDips_description = "Stand facing away from a bench, grab it with both hands at shoulder-width. Extend your legs out in front of you. Slowly lower your body by flexing at the elbows until your arm at forearm create a 90 degree angle. Using your triceps, lift yourself back to the starting position.";
        $planks_description = "Spread your fingers to make a wide, stable base. Line up your shoulders over your hands and heels over toes. Hold your body in a straight line from the top of your head down to your heels. Hold your core in tight, being careful not to let your stomach sag or your back round.";
        $crunches_description = "Lie down on your back. Plant your feet on the floor, hip-width apart. Bend your knees and place your arms behind your head. Contract your abs and inhale. Exhale and lift your upper body, keeping your head and neck relaxed. Inhale and return to the starting position.";
        $superman_description = "Lie on the floor in a prone (facedown) position, with your legs straight and your arms extended in front of you. Keeping your head in a neutral position (avoid looking up), slowly lift your arms and legs until you feel your lower back muscles contracting.";
        $diamondPushUps_description = "In a diamond push-up, you touch your thumbs and index fingers together to make a diamond shape directly in front of the center of your chest.";
        $pullUps_description = "Start with your hands on the bar approximately shoulder-width apart with your palms facing forward. With arms extended above you, stick your chest out and curve your back slightly. That is your starting position. Pull yourself up towards the bar using your back until the bar is at chest level while breathing out. Slowly lower yourself to the starting position while breathing in.";
        $bicepCurls_description = "Stand by holding a dumbbell in each hand with your arms hanging by your sides. Ensure your elbows are close to your torso and your palms facing forward. Keeping your upper arms stationary, exhale as you curl the weights up to shoulder level while contracting your biceps.";

        // Video links
        $regularPushUps_link = "https://www.youtube.com/watch?v=IODxDxX7oi4";
        $tricepDips_link = "https://www.youtube.com/watch?v=l1itVZTVDDo";
        $planks_link = "https://www.youtube.com/watch?v=pvIjsG5Svck";
        $crunches_link = "https://www.youtube.com/watch?v=MKmrqcoCZ-M";
        $superman_link = "https://www.youtube.com/watch?v=J9zXkxUAfUA";
        $diamondPushUps_link = "shttps://www.youtube.com/watch?v=pD3mD6WgykM";
        $pullUps_link = "https://www.youtube.com/watch?v=eGo4IYlbE5g";
        $bicepCurls_link = "https://www.youtube.com/watch?v=XE_pHwbst04";


        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 60, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 3, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 3, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 4, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups will work your back. Bicep curls will work your biceps", $plan->id, $user->id, 3, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 4, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 70, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 14, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 7, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 14, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 7, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 4, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups work your back. Bicep curls will work your biceps", $plan->id, $user->id, 7, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 4, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 75, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 15, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 11, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 15, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 11, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups will work your back. Bicep curls will work your biceps", $plan->id, $user->id, 11, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, $bicepCurls_link);
        }


        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 80, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 16, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 15, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 16, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 15, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups will work your back. Bicep curls will work your biceps", $plan->id, $user->id, 15, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 11, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 11, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 85, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 17, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 19, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 17, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 11, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 19, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 11, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups work your back. Bicep curls will work your biceps", $plan->id, $user->id, 19, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 11, 3, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 90, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 18, 3, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 23, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 18, 3, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 23, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups work your back. Bicep curls will work your biceps", $plan->id, $user->id, 23, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 12, 3, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular push ups and Tricep dips", "Regular pushups will work your chest and triceps. Tricep dips will work your triceps", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 10, 4, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Tricep Dips", $tricepDips_description, $workout_id, $user->id, 10, 4, null, $coefficient, -1, $tricepDips_link);

        $workout_id = $this->makeWorkout("Planks and Crunches", "Planks will work your core. Crunches will work your abs", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("Planks", $planks_description, $workout_id, $user->id, null, null, 90, $coefficient, 1, $planks_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 14, 4, null, $coefficient, -1, $crunches_link);

        if (!$this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Superman and Diamond push ups", "Superman will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 27, 0, $coefficient);
            $this->makeExercise("Superman", $superman_description, $workout_id, $user->id, 14, 4, null, $coefficient, -1, $superman_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 10, 4, null, $coefficient, -1, $diamondPushUps_link);
        }
        elseif ($this->hasPullUpBar && !$this->hasDumbbells)
        {
            $workout_id = $this->makeWorkout("Pull ups and Diamond push ups", "Pull ups will work your back. Diamond push ups will work your biceps", $plan->id, $user->id, 27, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 4, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 10, 4, null, $coefficient, -1, $diamondPushUps_link);
        }
        else
        {
            $workout_id = $this->makeWorkout("Pull ups and Bicep curls", "Pull ups will work your back. Bicep curls will work your biceps", $plan->id, $user->id, 27, 0, $coefficient);
            $this->makeExercise("Pull ups", $pullUps_description, $workout_id, $user->id, 5, 4, null, $coefficient, -1, $pullUps_link);
            $this->makeExercise("Bicep curls", $bicepCurls_description, $workout_id, $user->id, 10, 4, null, $coefficient, -1, $bicepCurls_link);
        }

        $workout_id = $this->makeWorkout("Regular push ups, Diamond push ups, Crunches", "Regular push ups will work your chest and triceps. Diamond push ups will work your biceps. Crunches will work your abs.", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("Regular push ups", $regularPushUps_description, $workout_id, $user->id, 12, 4, null, $coefficient, -1, $regularPushUps_link);
        $this->makeExercise("Diamond push ups", $diamondPushUps_description, $workout_id, $user->id, 12, 4, null, $coefficient, -1, $diamondPushUps_link);
        $this->makeExercise("Crunches", $crunches_description, $workout_id, $user->id, 16, 4, null, $coefficient, -1, $crunches_link);
    }

    private function makeLowerBodyWorkouts($coefficient, $user, $plan)
    {
        // Descriptions
        $regularSquats_description = "Stand with your feet shoulder-width apart, toes slightly out, core braced, and chest up. Initiate a basic squat movement — hips back, knees bent, ensuring they fall out, not in. Pause when your thighs reach about parallel to the ground. Push through your entire foot to return to start.";
        $sumoSquats_description = "Stand with your feet slightly wider than hip-width apart, your toes pointing outward at about 45 degrees. Your hips should be rotated outward, too. This is the starting position. Inhale while pushing your hips back and lowering into a squat position. Keep your core tight, back straight, and knees forward during this movement. Exhale while returning to the starting position. Focus on keeping your weight evenly distributed throughout your heel and midfoot.";
        $bulgarianSplitSquats_description = "Find yourself a step, bench or any other contraption that you can rest a foot on, it needs to be about knee height. Get into a forward lunge position with torso upright, core braced and hips square to your body, with your back foot elevated on the bench. Your leading leg should be half a metre or so in front of bench. Lower until your front thigh is almost horizontal, keeping your knee in line with your foot. Don't let your front knee travel beyond your toes. Drive up through your front heel back to the starting position, again keeping your movements measured.";
        $gluteBridges = "Lie on your back and set your knees about shoulder-width apart, with your feet flat to the ground and your knees bent. ... Slowly raise your hips, engage your glutes, and squeeze your abs. Be careful not to arch your back as you lift your hips as high as possible.";
        $squatJumps = "Stand with feet shoulder width and knees slightly bent. Bend your knees and descend to a full squat position. Engage through the quads, glutes, and hamstrings and propel the body up and off the floor, extending through the legs. With the legs fully extended, the feet will be a few inches (or more) off the floor. Descend and control your landing by going through your foot (toes, ball, arches, heel) and descend into the squat again for another explosive jump. Upon landing immediately repeat the next jump.";

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 1, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 2, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 3, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 6, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 4, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 5, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 6, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 7, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 7, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 8, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 9, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 10, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 11, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 8, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 12, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 13, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 14, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 15, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 9, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 16, 1, $coefficient);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 17, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 18, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 19, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 10, 3, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your day off.. let's relax", $plan->id, $user->id, 20, 1, $coefficient, -1);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 21, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 22, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 23, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("FREE", "It's your last day off in this plan.. let's relax", $plan->id, $user->id, 24, 1, $coefficient, -1);

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 25, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");

        $workout_id = $this->makeWorkout("Regular squats and Bulgarian split squat", "Both of these exercises will work your Glutes, Quads and Hamstrings", $plan->id, $user->id, 26, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Bulgarian split squat", $bulgarianSplitSquats_description, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=HBYGeyb4sSM");

        $workout_id = $this->makeWorkout("Glute Bridges and Squat Jumps", "Glute bridges will put an emphasis on your glutes and Squat Jumps will put an emphasis on your calves as well es quad", $plan->id, $user->id, 27, 0, $coefficient);
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");

        $workout_id = $this->makeWorkout("Regular squats, Sumo squats, Glute Bridges and Squat Jumps", "These exercises will work Glutes, Quads, Hamstrings and Calves", $plan->id, $user->id, 28, 0, $coefficient);
        $this->makeExercise("Regular squats", $regularSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=aclHkVaku9U");
        $this->makeExercise("Sumo squats", $sumoSquats_description, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=kjlfpqXnyL8");
        $this->makeExercise("Glute Bridges", $gluteBridges, $workout_id, $user->id, 8, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=OUgsJ8-Vi0E");
        $this->makeExercise("Squat Jumps", $squatJumps, $workout_id, $user->id, 9, 4, null, $coefficient, -1, "https://www.youtube.com/watch?v=A-cFYWvaHr0");
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

    private function makeExercise($name, $description, $workout_id, $user_id, $reps, $sets, $duration,  $coefficient, $duration_type, $video_url = null)
    {
        $exercise = new Exercise();
        $exercise->name = $name;
        $exercise->description = $description;
        $exercise->workout_id = $workout_id;
        $exercise->user_id = $user_id;
        $exercise->reps = ceil($reps * $coefficient);
        $exercise->sets = ceil($sets * $coefficient);
        if ($duration != null)
        {
            $exercise->duration = $duration * $coefficient;
            $exercise->duration_type = $duration_type;
        }
        $exercise->info_video_url = $video_url;
        $exercise->save();
    }
}

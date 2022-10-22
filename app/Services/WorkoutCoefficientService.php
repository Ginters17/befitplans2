<?php

namespace App\Services;


class WorkoutCoefficientService
{
    public function getCoefficient($user)
    {
        $coefficient = 1;
        $user->sex;
        $user->height;
        $user->weight;
        $user->age;

        /// Body mass index
        $BMI = $user->weight / ($user->height * $user->height);

        /// Underweight
        if($BMI < 18.5)
        {
            $coefficient -= 0.1;
        }
        /// Normal weight
        elseif($BMI >= 18.5 && $BMI < 24.9)
        {
            $coefficient += 0;
        }
        /// Overweight
        elseif($BMI >= 25 && $BMI < 30)
        {
            $coefficient -= 0.1;
        }
        /// Obesity
        elseif($BMI >= 30)
        {
            $coefficient -= 0.33;
        }

        if($user->sex)
        {
            $coefficient -= 0.1;
        }

        if($user->age > 13 && $user->age < 17)
        {
            $coefficient -= 0.1;
        }
        elseif($user->age >= 17 && $user->age < 30)
        {
            $coefficient += 0.1;
        }
        elseif($user->age >= 30 && $user->age < 50)
        {
            $coefficient -= 0.1;
        }
        elseif($user->age >= 50)
        {
            $coefficient -= 0.33;
        }

        return $coefficient;
    }
}

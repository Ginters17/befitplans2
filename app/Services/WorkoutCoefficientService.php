<?php

namespace App\Services;


class WorkoutCoefficientService
{
    // Returns coefficient based on 3 factors:
    // 1) body mass index
    // 2) sex
    // 3) age
    public function getCoefficient($user)
    {
        $coefficient = 1;
        $sex = $user->sex;
        $height = $user->height;
        $weight = $user->weight;
        $age = $user->age;

        /// BMI factor
        $coefficient += $this->getCoefficientBMI($weight, $height);

        /// Sex factor
        $coefficient += $this->getCoefficientSex($sex);

        /// Age factor
        $coefficient += $this->getCoefficientAge($age);

        return $coefficient;
    }

    // Get coefficient for body mass index
    private function getCoefficientBMI($weight, $height) {
        $BMICoefficient = 0;
        $BMI = $weight / ($height * $height);

        /// Underweight
        if($BMI < 18.5)
        {
            $BMICoefficient -= 0.1;
        }
        /// Normal weight
        elseif($BMI >= 18.5 && $BMI < 24.9)
        {
            $BMICoefficient += 0;
        }
        /// Overweight
        elseif($BMI >= 25 && $BMI < 30)
        {
            $BMICoefficient -= 0.1;
        }
        /// Obesity
        elseif($BMI >= 30)
        {
            $BMICoefficient -= 0.33;
        }

        return $BMICoefficient;
    }

    // Get coefficient for body mass index
    private function getCoefficientSex($sex) {
        $sexCoefficient = 0;
        
        // Female
        if($sex == 2)
        {
            $sexCoefficient -= 0.1;
        }
        // Male
        elseif($sex == 1)
        {
            $sexCoefficient += 0.1;
        }

        return $sexCoefficient;
    }

    // Get coefficient for age
    private function getCoefficientAge($age) {
        $ageCoefficient = 0;

        if($age > 13 && $age < 17)
        {
            $ageCoefficient -= 0.1;
        }
        elseif($age >= 17 && $age < 30)
        {
            $ageCoefficient += 0.1;
        }
        elseif($age >= 30 && $age < 50)
        {
            $ageCoefficient -= 0.1;
        }
        elseif($age >= 50)
        {
            $ageCoefficient -= 0.33;
        }

        return $ageCoefficient;
    }
}

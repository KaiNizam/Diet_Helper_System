<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Informations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function show()
    {
        $user = Auth::user(); // Retrieve the authenticated user
        $information = $user->information; // Retrieve the latest information for the user
    
        return view('user.Profile', compact('information'));
    }

    public function edit()
    {
        $user = Auth::user(); // Retrieve the authenticated user
        $information = $user->information; // Retrieve the latest information for the user
    
        return view('user.Update', compact('information'));
    }

    public function update(User $user, Request $request)
{
    $information = $user->information; // Retrieve the associated information record
    
    $user->update([
        'email' => $request->email,
        'age' => $request->age,
        'height' => $request->height,
        'activity_level' => $request->activity_level,
        'updated_at' => now()
    ]);

    $information->update([
        'weight' => $request->weight,
        'max_calories_intake' => self::calculateDailyCalory($request->age, $request->gender, $request->height, $request->weight, $request->activity_level),
        'updated_at' => now()
    ]);

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $user->save();
    }

    return view('user.profile', compact('user', 'information'));
}


    // Function to calculate daily calory based on user information
    private static function calculateDailyCalory($age, $gender, $height, $weight, $activityLevel)
    {
        // Calculate BMR (Basal Metabolic Rate)
        if ($gender == 'male') {
            $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
        } else {
            $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
        }

        // Multiply BMR by activity level
        switch ($activityLevel) {
            case 'sedentary':
                $dailyCalory = $bmr * 1.2;
                break;
            case 'lightly_active':
                $max_calories_intake = $bmr * 1.375;
                break;
            case 'moderately_active':
                $max_calories_intake = $bmr * 1.55;
                break;
            case 'very_active':
                $max_calories_intake = $bmr * 1.725;
                break;
            case 'extra_active':
                $max_calories_intake = $bmr * 1.9;
                break;
            default:
                $max_calories_intake = $bmr * 1.2;
                break;
        }

        return round($max_calories_intake);
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Informations;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'integer', 'min:18', 'max:100'],
            'gender' =>['required', 'string', 'in:Male,Female'],
            'height' => ['required', 'numeric', 'min:1', 'max:300'], // added height field validation rules
            'weight' => ['required', 'numeric', 'min:1', 'max:500'], // added weight field validation rulesqqwww
            'activity_level' => ['required', 'string', 'in:Sedentary,Lightly Active,Moderately Active,Very Active,Extra Active'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $data['age'],
            'gender' => $data['gender'],
            'height' => $data['height'], // added height field
            'activity_level' => $data['activity_level'],
        ]);

        $information = Informations::create([
            'user_id' => $user->id,
            'weight' => $data['weight'],
        ]);
        
        $this->calculateAndSaveDailyCalories($user->id, $information->id);

        return $user;
    }

    /**
     * Calculate and save the user's daily calories.
     *
     * @param  int  $user_id
     * @return float
     */
    protected function calculateAndSaveDailyCalories($user_id, $information_id)
    {
        // Retrieve user data from database
        $user = User::find($user_id);
        $information = Informations::find($information_id);
        $age = $user->age;
        $height = $user->height;
        $weight = $information->weight;
        $gender = $user->gender;
        $activityLevel = $user->activity_level;

// Determine the person's basal metabolic rate (BMR) based on gender
if ($gender == 'male') {
    $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
} else {
    $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
}

// Multiply BMR by activity level
switch ($activityLevel) {
    case 'sedentary':
        $max_calories_intake = $bmr * 1.2;
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

// Save the calculated daily calories into the database
$information->max_calories_intake = $max_calories_intake;
$information->save();

return $max_calories_intake;
    }
}
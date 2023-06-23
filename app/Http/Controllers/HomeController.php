<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Informations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
{
    $user = Auth::user(); // Retrieve the user by ID

// Retrieve the latest data for the user
$information = $user->information;
$caloryOuttakes =$user->caloryOuttakes;
$caloryIntakes =$user->caloryIntakes;

// Retrieve the user's total breakfast calorie intake for today
$totalCalorieIntakeBreakfast = DB::table('calory_intakes')
->where('user_id', $user->id)
->whereDate('created_at', now()->toDateString())
->sum('breakfast_calorie_intake');

// Retrieve the user's total lunch calorie intake for today
$totalCalorieIntakeLunch = DB::table('calory_intakes')
->where('user_id', $user->id)
->whereDate('created_at', now()->toDateString())
->sum('lunch_calorie_intake');

// Retrieve the user's total dinner calorie intake for today
$totalCalorieIntakeDinner = DB::table('calory_intakes')
->where('user_id', $user->id)
->whereDate('created_at', now()->toDateString())
->sum('dinner_calorie_intake');

// Retrieve the user's total snack calorie intake for today
$totalCalorieIntakeSnack = DB::table('calory_intakes')
->where('user_id', $user->id)
->whereDate('created_at', now()->toDateString())
->sum('snack_calorie_intake');

// Retrieve the user's total calorie intake
$totalCalorieIntake = $user->caloryIntakes()
    ->whereDate('created_at', Carbon::today())
    ->latest('created_at')
    ->value('total_calorie_intake');

// Retrieve the user's total calorie outtake
$totalCalorieOuttake = $user->caloryOuttakes()
    ->whereDate('created_at', Carbon::today())
    ->latest('created_at')
    ->value('total_calorie_outtake');


// Calculate the remaining calories intake
$remainingCaloriesIntake = round($information->max_calories_intake - ($totalCalorieIntake - $totalCalorieOuttake));

// Update the remaining calories intake in the information record
$information->remaining_calories_intake = $remainingCaloriesIntake;
$information->save();
    
    return view('home', compact('information', 'caloryOuttakes', 'caloryIntakes', 'totalCalorieIntakeBreakfast', 'totalCalorieIntakeLunch',
    'totalCalorieIntakeDinner', 'totalCalorieIntakeSnack', 'totalCalorieOuttake'));
}
}

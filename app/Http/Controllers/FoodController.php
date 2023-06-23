<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Foods;
use App\Models\User;
use App\Models\Calory_Intakes;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.FoodSearch');
    }
    

public function search(Request $request)
{
    $query = $request->input('query');
    $foods = Foods::where('food_name', 'like', '%'.$query.'%')->get();
    
    $userCaloryIntakes = $this->getUserCaloryIntakes();
    
    return view('food.FoodResult', compact('query', 'foods', 'userCaloryIntakes'));
}

public function getUserCaloryIntakes()
{
    $user = Auth::user();
    return $user->caloryIntakes;
}

    
   public function addToAccount(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'food_id' => 'required',
        'quantity' => 'required',
        'meal' => 'required',
    ], [
        'user_id.required' => 'The user ID is required.',
        'food_id.required' => 'The food ID is required.',
        'quantity.required' => 'The quantity is required.',
        'meal.required' => 'The meal field is required.',
    ]);

    $userId = $request->input('user_id');
    $foodId = $request->input('food_id');
    $quantity = $request->input('quantity');
    $meal = $request->input('meal');
       
    // Find the user by ID
    $user = User::find($userId);

    // Find the food by ID
    $food = Foods::find($foodId);

    // Create a new Calory_Intakes record
    $caloryIntake = new Calory_Intakes();
    $caloryIntake->user_id = $userId;
    $caloryIntake->quantity = $quantity;
    $caloryIntake->food_id = $foodId;
    $caloryIntake->created_at = now(); // Set the current date and tim

    // Determine meal type and set appropriate calorie intake field
    switch ($meal) {
        case 'Breakfast':
            $caloryIntake->breakfast_calorie_intake = $food->food_calory * $quantity;
            break;
        case 'Lunch':
            $caloryIntake->lunch_calorie_intake = $food->food_calory * $quantity;
            break;
        case 'Dinner':
            $caloryIntake->dinner_calorie_intake = $food->food_calory * $quantity;
            break;
        case 'Snack':
            $caloryIntake->snack_calorie_intake = $food->food_calory * $quantity;
            break;
        default:
            return response()->json(['error' => 'Invalid meal type provided.'], 400);
    }
    
    $caloryIntake->meal = $meal;
    $caloryIntake->save();

   // Calculate the user's total calorie intake
   $totalCalorieIntake = $user->caloryIntakes()
        ->whereDate('created_at', $caloryIntake->created_at->toDateString()) // Filter by the date of data created
        ->sum('breakfast_calorie_intake')
        + $user->caloryIntakes()
            ->whereDate('created_at', $caloryIntake->created_at->toDateString()) // Filter by the date of data created
            ->sum('lunch_calorie_intake')
        + $user->caloryIntakes()
            ->whereDate('created_at', $caloryIntake->created_at->toDateString()) // Filter by the date of data created
            ->sum('dinner_calorie_intake')
        + $user->caloryIntakes()
            ->whereDate('created_at', $caloryIntake->created_at->toDateString()) // Filter by the date of data created
            ->sum('snack_calorie_intake');

    // Update the user's total calorie intake
    $caloryIntake->total_calorie_intake = $totalCalorieIntake;
    $caloryIntake->save();

    return view('food.FoodSearch', compact('user', 'food', 'caloryIntake'));
    }

    public function showCaloryIntakes()
{
    $user = Auth::user();
    
    $caloryIntakes = $user->caloryIntakes()
        ->whereDate('created_at', Carbon::today())
        ->get();

    return view('food.CaloryIntakes', compact('caloryIntakes'));
}


public function deleteCaloryIntake($id)
{
    $caloryIntake = Calory_Intakes::find($id);

    if (!$caloryIntake) {
        return redirect()->back()->withErrors('Calory intake not found.');
    }

    $caloryIntake->delete();

    return redirect()->back()->withSuccess('Calory intake deleted successfully.');
}   
}

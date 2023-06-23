<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Exercises;
use App\Models\Calory_Outtakes;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {
        return view('exercise.ExerciseSearch');
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    $exercises = Exercises::where('exercise_name', 'like', '%'.$query.'%')->get();
    
    
    return view('exercise.ExerciseResult', compact('query', 'exercises', ));;
}

public function addToAccount(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'exercise_id' => 'required',
        'quantity' => 'required',
    ], [
        'user_id.required' => 'The user ID is required.',
        'exercise_id.required' => 'The exercise ID is required.',
        'quantity.required' => 'The quantity is required.',
    ]);

    $userId = $request->input('user_id');
    $exerciseId = $request->input('exercise_id');
    $quantity = $request->input('quantity');
       
    // Find the user by ID
    $user = User::find($userId);

    // Find the Exercise by ID
    $exercise = Exercises::find($exerciseId);

    // Create a new Calory_Outtakes record
    $caloryOuttake = new Calory_Outtakes();
    $caloryOuttake->user_id = $userId;
    $caloryOuttake->quantity = $quantity;
    $caloryOuttake->exercise_id = $exerciseId;
    $caloryOuttake->created_at = now(); // Set the current date and tim

    $totalCalorieOuttake = Calory_Outtakes::where('user_id', $userId)
    ->whereDate('created_at', $caloryOuttake->created_at->toDateString()) // Filter by the date of data created
    ->sum('total_calorie_outtake')
    + ($exercise->calory_burn * $quantity);

// Create or update the Calory_Outtakes record
$caloryOuttake = Calory_Outtakes::updateOrCreate(
    [
        'user_id' => $userId,
        'exercise_id'=>$exerciseId,
        'quantity'=>$quantity,
        'created_at' => $caloryOuttake->created_at->toDateString(),
    ],
    [
        'total_calorie_outtake' => $totalCalorieOuttake,
    ]
);

    return view('exercise.ExerciseSearch', compact('user', 'exercise'));
    }

    public function showCaloryOuttakes()
{
    $user = Auth::user();
    
    $caloryOuttakes = $user->caloryOuttakes()
        ->whereDate('created_at', Carbon::today())
        ->get();

    return view('exercise.CaloryOuttakes', compact('caloryOuttakes'));
}

    
    
    public function deleteCaloryOuttake($id)
    {
        $caloryOuttake = Calory_Outtakes::find($id);
    
        if (!$caloryOuttake) {
            return redirect()->back()->withErrors('Calory outtake not found.');
        }
    
        $caloryOuttake->delete();
    
        return redirect()->back()->withSuccess('Calory outtake deleted successfully.');
    }
    
}

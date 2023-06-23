<?php

use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Welcome');
});

Auth::routes();
// In routes/web.php

//User
Route::get('/user/Profile', [UserController::class, 'show'])->name('Profile.show');
Route::get('/home', [HomeController::class, 'show']);
Route::get('user/Update', [UserController::class, 'edit'])->name('user.Update.edit');
Route::post('/user/Update/{user}',[UserController::class,'update'])->name('Update.update');

//Food
Route::get('/food/FoodSearch', [FoodController::class, 'index'])->name('food.FoodSearch');
Route::get('/food/FoodResult', [FoodController::class, 'search'])->name('food.FoodSearch');
Route::post('/food/addToAccount', [FoodController::class, 'addToAccount'])->name('food.addToAccount');
Route::get('/calory-intakes', [FoodController::class, 'showCaloryIntakes'])->name('caloryIntakes');
Route::delete('/calory-intakes/{id}', [FoodController::class, 'deleteCaloryIntake'])->name('caloryIntakeDelete');



//Exercise
Route::get('/exercise/ExerciseSearch', [ExerciseController::class, 'index'])->name('exercise.ExerciseSearch');
Route::get('/exercise/ExerciseResult', [ExerciseController::class, 'search'])->name('exercise.ExerciseSearch');
Route::post('/exercise/addToAccount', [ExerciseController::class, 'addToAccount'])->name('exercise.addToAccount');
Route::get('/calory-outtakes', [ExerciseController::class, 'showCaloryOuttakes'])->name('caloryOuttakes');
Route::delete('/calory-outtakes/{id}', [ExerciseController::class, 'deleteCaloryOuttake'])->name('caloryOuttakeDelete');


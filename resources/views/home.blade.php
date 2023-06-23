@extends('layouts.app')

@section('content')
    <head>
        <link href="/css/home.css" rel="stylesheet">
    </head>

    <!-- navigation bar -->
    <nav>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="/food/FoodSearch">Food</a></li>
			<li><a href="/exercise/ExerciseSearch">Exercise</a></li>
		</ul>
	</nav>
  <!-- navigation bar -->

<div class="wrapper">
    <div class="container-left">
        <div class="left-container">
            <table class="table">
                <tr>
                    <td>Meal</td>
                    <td>Calorie</td>
                </tr>
                <tr>
                    <td>Breakfast: </td>
                    <td>{{ round($totalCalorieIntakeBreakfast) }}</td>    
                </tr>
                <tr>
                    <td>Lunch:</td>
                    <td>{{ round($totalCalorieIntakeLunch) }}</td>    
                </tr>
                <tr>
                    <td>Dinner:</td>
                    <td>{{ round($totalCalorieIntakeDinner) }}</td>    
                </tr>
                <tr>
                    <td>Snack:</td>
                    <td>{{ round($totalCalorieIntakeSnack) }}</td>    
                </tr>
                <tr>
                    <td>Total:</td>
                    <td>@if ($caloryIntakes->isNotEmpty())
                        {{ round($caloryIntakes->last()->total_calorie_intake) }}
                    @else
                        0
                    @endif</td>    
                </tr>
            </table>
        </div>
    </div>

    <div class="container-center">
        <div class="above mx-auto">Calories Remaining</div>
            <div class="circle mx-auto">
                <div class="text">{{ $information->remaining_calories_intake }}</div>
            </div>
        <div class="text below mx-auto">Daily Calory Limit <br> {{ $information->max_calories_intake }}</div>
    </div>

    <div class="container-right">
        <div class="right-container">
            <table>
                <tr>
                    <td></td>
                    <td>Calorie</td>
                </tr>
            <tr>
                <td>Calories Burned:</td>
                <td>
                @if ($caloryOuttakes->isNotEmpty())
                {{ round($caloryOuttakes->last()->total_calorie_outtake) }}
                @else
                 0
                @endif
                    </td>
            </tr>
            </table>
        </div>
    </div>
</div>

@endsection

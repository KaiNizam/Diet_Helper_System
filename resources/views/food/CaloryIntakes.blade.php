<!-- resources/views/food/CaloryIntakes.blade.php -->

@extends('layouts.app')

@section('content')

<head>
    <link href="/css/style.css" rel="stylesheet">
   
  </head>

  <nav>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="#">Food</a></li>
			<li><a href="/exercise/ExerciseSearch">Exercise</a></li>
		</ul>
	</nav>

  <div class="container">
    <div class="navigation">
        <a href="/food/FoodSearch" class="highlight">Food</a><span> > Calory Intakes</span>
    </div>

  <div class="table-container">

    <h1>Calory Intakes</h1>
    <table>
      <thead>
        <tr>
          <th>Meal</th>
          <th>Food</th>
          <th>Calorie Intake</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($caloryIntakes as $caloryIntake)
  <tr>
    <td>{{ $caloryIntake->meal }}</td>
    <td>{{ $caloryIntake->food->food_name }}</td>
    <td>
  @switch($caloryIntake->meal)
    @case('Breakfast')
      {{ round($caloryIntake->breakfast_calorie_intake) }}
      @break
    @case('Lunch')
      {{ round($caloryIntake->lunch_calorie_intake) }}
      @break
    @case('Dinner')
      {{ round($caloryIntake->dinner_calorie_intake) }}
      @break
    @case('Snack')
      {{ round($caloryIntake->snack_calorie_intake) }}
      @break
    @default
      N/A
  @endswitch
</td>

    <td>
      <form action="{{ route('caloryIntakeDelete', $caloryIntake->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
      </form>
    </td>
  </tr>
@endforeach

      </tbody>
    </table>
    @if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="error-message">
      @foreach ($errors->all() as $error)
        {{ $error }}
      @endforeach
    </div>
  @endif
  </div>
@endsection

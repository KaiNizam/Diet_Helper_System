@extends('layouts.app')

@section('content')
  <head>
    <link href="/css/style.css" rel="stylesheet">
   
  </head>

  <!-- navigation bar -->
  <nav>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="/food/FoodSearch">Food</a></li>
			<li><a href="#">Exercise</a></li>
		</ul>
	</nav>
  <!-- navigation bar -->
  <div class="container">
    <div class="navigation">
      Exercise
    </div>

    <div class="top">


      <div class="search-container">
        <form action="{{ route('exercise.ExerciseSearch') }}" method="get" class="food-table">
          <input type="text" name="query" placeholder="Search for a exercise">
          <button type="submit">Search</button>
        </form>
      </div>
    </div>

    <h3><a href="{{ route('caloryOuttakes') }}">View Calory Outtakes</a></h3>
  </div>
@endsection

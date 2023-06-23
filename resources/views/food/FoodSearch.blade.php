@extends('layouts.app')

@section('content')
  <head>
    <link href="/css/style.css" rel="stylesheet">
   
  </head>

  <!-- navigation bar -->
  <nav>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="#">Food</a></li>
			<li><a href="/exercise/ExerciseSearch">Exercise</a></li>
		</ul>
	</nav>
  <!-- navigation bar -->
  <div class="container">
    <div class="navigation">
      Food
    </div>

    <div class="top">
    
      <div class="search-container">
        <form action="{{ route('food.FoodSearch') }}" method="get" class="food-table">
          <input type="text" name="query" placeholder="Search for a food">
          <button type="submit">Search</button>
        </form>
      </div>
    </div>

    <h3><a href="{{ route('caloryIntakes') }}">View Calory Intakes</a></h3>
  </div>
@endsection

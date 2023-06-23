@extends('layouts.app')

@section('content')
    <head>
        <link href="/css/profile.css" rel="stylesheet">
    </head>

    <!-- navigation bar -->
    <nav>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="/food/FoodSearch">Food</a></li>
			<li><a href="/exercise/ExerciseSearch">Exercise</a></li>
		</ul>
	</nav>
    <!-- navigation bar -->

	<main>
		<section class="main">
            <div id="center-top">
                <div class="container">
                    <img src="/pic/profile.png" alt="Your image description here">

                    <div class="button-container">
                        <a href="{{ route('user.Update.edit') }}"  class="button1">Update</a>
                        
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <td class="col1">Username: </td>
                        <td class="col2">{{ Auth::user()->username }}</td>    
                        <td class="col3">Email:</td>
                        <td class="col4">{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="col1">Weight:</td>
                        <td class="col2">{{ $information->weight }}</td>    
                        <td class="col3">Height:</td>
                        <td class="col4">{{ Auth::user()->height }}</td>
                    </tr>
                    <tr>
                        <td class="col1">Gender:</td>
                        <td class="col2"> {{ Auth::user()->gender }}</td>    
                        <td class="col3">Age:</td>
                        <td class="col4">{{ Auth::user()->age }}</td>
                    </tr>
                </table>
                <h1>Activity level:  {{ Auth::user()->activity_level }}</h1>
                <h1>Daily calory:   {{ $information->max_calories_intake }}</h1>
            </div>
		</section>
	</main>
@endsection

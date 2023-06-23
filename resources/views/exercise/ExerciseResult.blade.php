@extends('layouts.app')

@section('content')
<head>
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/popup.css" rel="stylesheet">

    <script src="/js/popup.js"></script>
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
        <a href="/exercise/ExerciseSearch" class="highlight">Exercise</a><span> > Search</span>
    </div>

    <div class="search-container">
        <form action="{{ route('exercise.ExerciseSearch') }}" method="get">
            <input type="text" name="query" placeholder="Search for a exercise">
            <button type="submit">Search</button>
        </form>
        <p class="search-results">Search results for "{{ $query }}":</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th class="middle-column">Name</th>
                    <th>Calory Burn</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($exercises as $exercise)
                <tr>
                    <td class="middle-column">{{ $exercise->exercise_name }}</td>
                    <td>{{ $exercise->calory_burn}}</td>
                    <td>
                        <!-- Add Button -->
                        <button class="add" onclick="showPopup('{{ $exercise->exercise_name }}', '{{ $exercise->calory_burn }}')">Add</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Pop-up Screen -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="popup-close" onclick="hidePopup()">&times;</span>

        @foreach ($exercises as $exercise)
        <form class="popup-form" action="{{ route('exercise.addToAccount') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                        <td>{{ $exercise->exercise_name }}</td>
                        <td>Calories: {{ $exercise->calory_burn }}</td>
                    </tr>
                    <tr>
                        <td>
                            <label for="quantity">Quantity:</label>
                            <input type="text" id="quantity" name="quantity" required>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-buttons">
                <button type="submit" class="submit-button">Submit</button>
                <button type="button" onclick="hidePopup()" class="cancel-button">Cancel</button>
            </div>
        </form>
        @endforeach
    </div>
</div>
@endsection

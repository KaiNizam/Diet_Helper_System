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
			<li><a href="#">Food</a></li>
			<li><a href="/exercise/ExerciseSearch">Exercise</a></li>
		</ul>
	</nav>
<!-- navigation bar -->

<div class="container">
    <div class="navigation">
        <a href="/food/FoodSearch" class="highlight">Food</a><span> > Search</span>
    </div>

    <div class="search-container">
        <form action="{{ route('food.FoodSearch') }}" method="get">
            <input type="text" name="query" placeholder="Search for a food">
            <button type="submit">Search</button>
        </form>
        <p class="search-results">Search results for "{{ $query }}":</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th class="middle-column">Name</th>
                    <th>Calories</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($foods as $food)
                <tr>
                    <td class="middle-column">{{ $food->food_name }}</td>
                    <td>{{ $food->food_calory }}</td>
                    <td>
                        <!-- Add Button -->
                        <button class="add" onclick="showPopup('{{ $food->food_name }}', '{{ $food->food_calory }}')">Add</button>
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
    @foreach ($foods as $food)
        <span class="popup-close" onclick="hidePopup()">&times;</span>
        <div class="image-container">

            <img src="{{ $food->img }}" alt="Your image description here">
        </div>
        <form class="popup-form" action="{{ route('food.addToAccount') }}" method="POST">
            @csrf
            <table>
                <tbody>
                    <tr>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="food_id" value="{{ $food->id }}">
                        <td>{{ $food->food_name }}</td>
                        <td>Calories: {{ $food->food_calory }}</td>
                    </tr>
                    <tr>
                        <td>{{ $food->food_description }}</td>
                    </tr>
                    <tr>
                        <td>
                            <label for="meal">Meal: </label>
                            <select id="meal" name="meal" required>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </td>
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

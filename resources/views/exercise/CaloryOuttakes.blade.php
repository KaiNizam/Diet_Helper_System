
@extends('layouts.app')

@section('content')

<head>
    <link href="/css/style.css" rel="stylesheet">
   
  </head>

  <nav>
		<ul>
			<li><a href="/home">Home</a></li>
			<li><a href="/food/FoodSearch">Food</a></li>
			<li><a href="#">Exercise</a></li>
		</ul>
	</nav>

  <div class="container">
    <div class="navigation">
        <a href="/exercise/ExerciseSearch" class="highlight">Exercise</a><span> > Calory Outtakes</span>
    </div>

  <div class="table-container">

    <h1>Calory Outtakes</h1>
    <table>
      <thead>
        <tr>
          <th>Exercise</th>
          <th>Calorie Burn</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($caloryOuttakes as $caloryOuttake)
  <tr>
  <td>{{ $caloryOuttake->exercise->exercise_name }}</td>
<td>{{ $caloryOuttake->exercise->calory_burn * $caloryOuttake->quantity }}</td>
    <td>
      <form action="{{ route('caloryOuttakeDelete', $caloryOuttake->id) }}" method="POST">
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

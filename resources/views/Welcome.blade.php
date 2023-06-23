
@extends('layouts.app')

@section('content')
    <head>
        <link href="/css/welcome.css" rel="stylesheet">
    </head>

    <!-- navigation bar -->
    <nav>
	    <ul>
	        <li><a href="#">Home</a></li>
		    <li><a href="#">Food</a></li>
		    <li><a href="#">Exercise</a></li>
	    </ul>
    </nav>
    <!-- navigation bar -->

    <main>
	    <section class="main">
		    <h1>DIET start with what FOOD<br> you CONSUME and ACTIVITY<br> you had DONE</h1>
		    <p class="text">Get ideal weight by simply manage <br>
            calories deficit everday.  Track <br>
            calories, record exercise and read <br>
            useful tips.</p>

            <div class="register-container">
                <a href="register" class="register-btn">REGISTER</a>
			    <p class="login-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>

            <div class="image-container1">
                <img src="/pic/jog.png" alt="Your image description here">
            </div>

            <div class="image-container2">
                <img src="/pic/pyramid.png" alt="Your image description here">
            </div>          
		</section>
    </main>
@endsection
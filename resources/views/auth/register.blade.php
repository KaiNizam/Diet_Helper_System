@extends('layouts.app')

@section('content')
<head>
    <link href="/css/body.css" rel="stylesheet">
</head>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="">Select gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control" name="age" required autocomplete="age">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="height" class="col-md-4 col-form-label text-md-end">{{ __('Height (cm)') }}</label>

                            <div class="col-md-6">
                                <input id="height" type="text" class="form-control" name="height" required autocomplete="height">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="weight" class="col-md-4 col-form-label text-md-end">{{ __('Weight (Kg)') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="text" class="form-control" name="weight" required autocomplete="weight">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="activity_level" class="col-md-4 col-form-label text-md-end">{{ __('Activity Level') }}</label>
                            <div class="col-md-6">
                                <select id="activity_level" name="activity_level" class="form-control @error('activity_level') is-invalid @enderror" required>
                                    <option value="">Select Activity Level</option>
                                    <option value="Sedentary" {{ old('activity_level') == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                                    <option value="Lightly Active" {{ old('activity_level') == 'Lightly_Active' ? 'selected' : '' }}>Lightly Active</option>
                                    <option value="Moderately Active" {{ old('activity_level') == 'Moderately_Active' ? 'selected' : '' }}>Moderately Active</option>
                                    <option value="Very Active" {{ old('activity_level') == 'Very_Active' ? 'selected' : '' }}>Very Active</option>
                                    <option value="Extra Active" {{ old('activity_level') == 'Extra_Active' ? 'selected' : '' }}>Extra Active</option>
                                </select>
                                @error('activity_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('template.master')
@section('title', 'Count Person')

@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        body {
            background-color:rgb(226, 223, 231);
            font-family: 'Arial', serif;
        }

        .card {
            border: none;
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
        }

        .form-control {
            border-radius: 12px;
            padding: 14px;
            font-size: 1rem;
            border: 1px solid #ccc;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #1a2a6c;
            box-shadow: 0 0 8px rgba(26, 42, 108, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));

            border: none;
            border-radius: 50px;
            padding: 10px 385px;
            font-weight: bold;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
             color: #ffffff; /* or any color you prefer */
    background-color: var(--primary-color); /* optional */
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);

        }

        .profile-card img {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            object-fit: cover;
            width: 100%;
            height: 250px;
        }

        .profile-info i {
            color: #b21f1f;
            font-size: 1.1rem;
        }

        .profile-info td {
            vertical-align: middle;
        }

        .fw-bold {
            color: #1a2a6c;
        }

        label.form-label {
            color: #1a2a6c;
            font-weight: 600;
        }

        hr {
            border-top: 2px solid #b21f1f;
            width: 60%;
            margin: 0.5rem auto 1rem;
        }
    </style>
@endsection


@section('content')
    @include('transaction.reservation.progressbar')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Form Card -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-3 text-center">Reservation Details</h4>
                        <form class="row g-3" method="GET"
                            action="{{ route('transaction.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                            <div class="col-md-12">
                                <label for="count_person" class="form-label">How many persons?</label>
                                <input type="number" class="form-control @error('count_person') is-invalid @enderror"
                                    id="count_person" name="count_person" value="{{ old('count_person') }}" min="1">
                                @error('count_person')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="check_in" class="form-label">Check-in Date</label>
                                <input type="date" class="form-control @error('check_in') is-invalid @enderror"
                                    id="check_in" name="check_in" value="{{ old('check_in') }}">
                                @error('check_in')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="check_out" class="form-label">Check-out Date</label>
                                <input type="date" class="form-control @error('check_out') is-invalid @enderror"
                                    id="check_out" name="check_out" value="{{ old('check_out') }}">
                                @error('check_out')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary shadow-sm">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Customer Profile Card -->
            <div class="col-md-4">
                <div class="card shadow-sm profile-card">
                    <img src="{{ $customer->user->getAvatar() }}">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $customer->name }}</h5>
                        <hr>
                        <table class="table table-borderless profile-info">
                            <tr>
                                <td><i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}"></i></td>
                                <td>{{ ucfirst($customer->gender) }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-briefcase"></i></td>
                                <td>{{ $customer->job }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-birthday-cake"></i></td>
                                <td>{{ $customer->birthdate }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt"></i></td>
                                <td>{{ $customer->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

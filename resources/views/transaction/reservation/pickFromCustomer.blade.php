@extends('template.master')
@section('title', 'User')

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
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.2);
        }

        .card img {
            height: 250px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
        }

        .search-bar {
            border-radius: 50px;
            padding: 12px 20px;
            font-size: 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease-in-out;
        }

        .search-bar:focus {
            border-color: #1a2a6c;
            box-shadow: 0 0 8px rgba(26, 42, 108, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));

            border: none;
            border-radius: 50px;
            padding: 10px 30px;
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

        .pagination-block {
            margin-top: 15px;
        }

        .fw-bold {
            color: #1a2a6c;
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
            <div class="col-lg-8">
                <form class="d-flex" method="GET" action="{{ route('transaction.reservation.pickFromCustomer') }}">
                    <input class="form-control search-bar me-2" type="search" placeholder="Search customers..." aria-label="Search"
                        name="q" value="{{ request()->input('q') }}">
                    <button class="btn btn-outline-primary px-4" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        @if (!empty(request()->input('q')))
            <div class="text-center mt-3">
                <h5>Results for "{{ request()->input('q') }}"</h5>
                <p class="text-muted">Total Found: {{ $customersCount }}</p>
            </div>
        @endif

        <div class="row mt-4">
            @foreach ($customers as $customer)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ $customer->user->getAvatar() }}" class="w-100">
                        <div class="card-body">
                            <h5 class="text-center fw-bold">{{ $customer->name }}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><i class="fas fa-envelope text-primary"></i></td>
                                        <td>{{ $customer->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-briefcase text-primary"></i></td>
                                        <td>{{ $customer->job }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-map-marker-alt text-primary"></i></td>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-birthday-cake text-primary"></i></td>
                                        <td>{{ $customer->birthdate }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('transaction.reservation.viewCountPerson', ['customer' => $customer->id]) }}"
                                    class="btn btn-primary mt-2">Choose</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-sm-10 d-flex justify-content-center">
                <div class="pagination-block">
                    {{ $customers->onEachSide(1)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>
@endsection

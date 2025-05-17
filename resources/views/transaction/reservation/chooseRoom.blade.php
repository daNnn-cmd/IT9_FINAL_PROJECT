@extends('template.master')

@section('title', 'Choose Room Reservation')

@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        body {
            background-color:rgb(226, 223, 231);
            font-family: 'Arial', serif;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card h2 {
            font-weight: 700;
            color: #1a2a6c;
        }

        .btn-luxury {
           background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));

            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-luxury:hover {
             color: #ffffff; /* or any color you prefer */
    background-color: var(--primary-color); /* optional */
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);

        }

        .room-card {
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.3s;
            background-color: #fff;
        }

        .room-card:hover {
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
            transform: scale(1.01);
        }

        .room-image {
            width: 250px;
            height: 100%;
            object-fit: cover;
        }

        .customer-card {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(to bottom, #ffffff, #f0f1f4);
            border-radius: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .customer-card img {
            border-radius: 50%;
            width: 110px;
            height: 110px;
            object-fit: cover;
            margin-bottom: 15px;
            border: 3px solid #1a2a6c;
        }

        .form-select {
            border-radius: 10px;
        }

        .pagination {
            justify-content: center;
        }
        
        .service-badge {
            display: inline-block;
            background-color:rgb(255, 255, 255);
            color: black;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    @include('transaction.reservation.progressbar')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Room Selection -->
            <div class="col-md-8">
                <div class="card p-4">
                    <h2 class="text-center">{{ $roomsCount }} Rooms Available</h2>
                    <p class="text-center text-muted">
                        For {{ request()->input('count_person') }}
                        {{ Helper::plural('People', request()->input('count_person')) }} from
                        {{ Helper::dateFormat(request()->input('check_in')) }} to
                        {{ Helper::dateFormat(request()->input('check_out')) }}
                    </p>
                    <hr>

                    <!-- Sort and Filter -->
                    <form method="GET" action="{{ route('transaction.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                        <div class="row g-2">
                            <input type="hidden" name="count_person" value="{{ request()->input('count_person') }}">
                            <input type="hidden" name="check_in" value="{{ request()->input('check_in') }}">
                            <input type="hidden" name="check_out" value="{{ request()->input('check_out') }}">

                            <div class="col-md-6">
                                <select class="form-select" name="sort_name">
                                    <option value="Price" {{ request()->input('sort_name') == 'Price' ? 'selected' : '' }}>Price</option>
                                    <option value="Number" {{ request()->input('sort_name') == 'Number' ? 'selected' : '' }}>Number</option>
                                    <option value="Capacity" {{ request()->input('sort_name') == 'Capacity' ? 'selected' : '' }}>Capacity</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" name="sort_type">
                                    <option value="ASC" {{ request()->input('sort_type') == 'ASC' ? 'selected' : '' }}>Ascending</option>
                                    <option value="DESC" {{ request()->input('sort_type') == 'DESC' ? 'selected' : '' }}>Descending</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-luxury w-100">Sort</button>
                            </div>
                        </div>
                    </form>

                    <!-- Rooms Display -->
                    <div class="mt-4">
                        @forelse ($rooms as $room)
                            <div class="room-card mb-3 border shadow-sm">
                                <img src="{{ $room->firstImage() }}" class="room-image">
                                <div class="p-4 flex-grow-1">
                                    <h4 class="mb-1">{{ $room->number }} - {{ $room->type->name }}</h4>
                                    <p class="text-muted">{{ $room->capacity }} {{ Str::plural('Person', $room->capacity) }}</p>
                                    <p class="mb-2"><strong>{{ Helper::convertToPesos($room->price) }}</strong> / Night</p>
                                    <p class="text-muted">{{ $room->view }}</p>
                                    
                                    <!-- Services Section -->
                                    @if($room->service)
                                        <div class="mb-2">
                                            <p class="mb-1"><strong>Includes:</strong></p>
                                            <span class="service-badge">
                                                {{ $room->service->name }} (+{{ Helper::convertToPesos($room->service->price) }})
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <a href="{{ route('transaction.reservation.confirmation', ['customer' => $customer->id, 'room' => $room->id, 'from' => request()->input('check_in'), 'to' => request()->input('check_out')]) }}"
                                       class="btn btn-luxury w-100 mt-2">Choose</a>
                                </div>
                            </div>
                        @empty
                            <h4 class="text-center text-muted">No available rooms for {{ request()->input('count_person') }} persons.</h4>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $rooms->onEachSide(1)->appends(request()->all())->links('template.paginationlinks') }}
                    </div>
                </div>
            </div>

            <!-- Customer Info Card -->
            <div class="col-md-4">
                <div class="customer-card">
                    <img src="{{ $customer->user->getAvatar() }}" alt="Avatar">
                    <h5 class="fw-bold">{{ $customer->name }}</h5>
                    <p class="text-muted mb-1"><i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}"></i> {{ $customer->gender }}</p>
                    <p class="mb-1"><i class="fas fa-user-md"></i> {{ $customer->job }}</p>
                    <p class="mb-1"><i class="fas fa-birthday-cake"></i> {{ $customer->birthdate }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $customer->address }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
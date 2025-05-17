@extends('template.master')
@section('title', 'Choose Day Reservation')
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

        .form-control {
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
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

        .fw-bold {
            color: #1a2a6c;
        }

        hr {
            border-top: 2px solidrgb(0, 0, 0);
            width: 60%;
            margin: 0.5rem auto 1rem;
        }

        .col-form-label {
            font-weight: 600;
            color: #333;
        }

        .float-end {
            background-color: #b21f1f;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: bold;
            color: white;
        }

        .table {
            font-size: 0.9rem;
            color: #333;
        }

        .table td {
            padding: 10px;
        }
        
        .service-badge {
           
            background: linear-gradient(to right,rgb(255, 255, 255),rgb(254, 254, 254));
            color: black;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-top: 5px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card shadow-sm border">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label for="room_number" class="col-sm-2 col-form-label">Room</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_number" name="room_number"
                                            placeholder="col-form-label" value="{{ $room->number }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_type" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_type" name="room_type"
                                            placeholder="col-form-label" value="{{ $room->type->name }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_capacity" class="col-sm-2 col-form-label">Capacity</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_capacity" name="room_capacity"
                                            placeholder="col-form-label" value="{{ $room->capacity }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_price" class="col-sm-2 col-form-label">Price / Day</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_price" name="room_price"
                                            placeholder="col-form-label"
                                            value="{{ Helper::convertToPesos($room->price) }}" readonly>
                                    </div>
                                </div>
                                @if($room->service)
                                <div class="row mb-3">
                                    <label for="room_service" class="col-sm-2 col-form-label">Service</label>
                                    <div class="col-sm-10">
                                        <div class="service-badge">
                                            {{ $room->service->name }} (+{{ Helper::convertToPesos($room->service->price) }}/day)
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr>
                            <div class="col-sm-12 mt-2">
                                <form method="POST"
                                    action="{{ route('transaction.reservation.payDownPayment', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="check_in" class="col-sm-2 col-form-label">Check In</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_in" name="check_in"
                                                placeholder="col-form-label" value="{{ $stayFrom }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="check_out" class="col-sm-2 col-form-label">Check Out</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_out" name="check_out"
                                                placeholder="col-form-label" value="{{ $stayUntil }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="how_long" class="col-sm-2 col-form-label">Total Day</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_long" name="how_long"
                                                placeholder="col-form-label"
                                                value="{{ $dayDifference }} {{ Helper::plural('Day', $dayDifference) }} "
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="total_price" name="total_price"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToPesos(Helper::getTotalPayment($dayDifference, $room->price + ($room->service ? $room->service->price : 0))) }} "
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_dp" class="col-sm-2 col-form-label">Minimum DP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToPesos($downPayment) }} " readonly>
                                        </div>
                                    </div>
                                   <div class="row mb-3">
    <label for="downPayment" class="col-sm-2 col-form-label">Payment</label>
    <div class="col-sm-10">
        <input type="text"
            class="form-control @error('downPayment') is-invalid @enderror"
            id="downPayment" name="downPayment" placeholder="Input payment here"
            value="{{ old('downPayment') }}">
        @error('downPayment')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        <!-- Payment Method Radios -->
        <div class="mt-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }}>
                <label class="form-check-label" for="payment_cash">Cash</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment_method" id="payment_gcash" value="gcash" {{ old('payment_method') == 'gcash' ? 'checked' : '' }}>
                <label class="form-check-label" for="payment_gcash">GCash</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment_method" id="payment_creditcard" value="creditcard" {{ old('payment_method') == 'creditcard' ? 'checked' : '' }}>
                <label class="form-check-label" for="payment_creditcard">Credit Card</label>
            </div>
            @error('payment_method')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" id="showPaymentType"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Pay DownPayment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow-sm">
                    <img src="{{ $customer->user->getAvatar() }}"
                        style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td style="text-align: center; width:50px">
                                    <span>
                                        <i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}">
                                        </i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-user-md"></i>
                                    </span>
                                </td>
                                <td>{{ $customer->job }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-birthday-cake"></i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->birthdate }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; ">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </td>
                                <td>
                                    {{ $customer->address }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<script>
    $('#downPayment').keyup(function() {
        $('#showPaymentType').text('Rp. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1.")
            .toString());
    });
</script>
@endsection
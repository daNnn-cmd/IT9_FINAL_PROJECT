@extends('template.master')
@section('title', $transaction->customer->name . ' Pay Reservation')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-9 mt-2">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">{{ $transaction->customer->name }} - Pay Reservation</h5>
                </div>
                <div class="card-body">
                    @php
                        $totalPrice = $transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out);
                        $paid = $transaction->getTotalPayment();
                        $balance = $totalPrice - $paid;
                    @endphp

                    @foreach ([
                        'Room' => $transaction->room->number,
                        'Check In' => Helper::dateFormat($transaction->check_in),
                        'Check Out' => Helper::dateFormat($transaction->check_out),
                        'Room Price' => Helper::convertToPesos($transaction->room->price),
                        'Days Count' => $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out),
                        'Total Price' => Helper::convertToPesos($totalPrice),
                        'Paid Off' => Helper::convertToPesos($paid),
                        'Insufficient' => Helper::convertToPesos($balance),
                    ] as $label => $value)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label fw-semibold text-dark">{{ $label }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $value }}" readonly>
                            </div>
                        </div>
                    @endforeach

                    <form method="POST" action="{{ route('transaction.payment.store', ['transaction' => $transaction->id]) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="payment" class="col-sm-2 col-form-label fw-semibold text-dark">Pay</label>
                            <div class="col-sm-10">
                                <input type="text" id="payment" name="payment" class="form-control @error('payment') is-invalid @enderror" placeholder="Enter payment amount">
                            </div>
                        </div>
                        @error('payment')
                            <div class="text-danger mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10" id="showPaymentType" class="fw-semibold text-info"></div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success px-4 shadow-sm"><i class="fas fa-money-bill-wave me-1"></i> Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3 mt-2">
            <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
                <img src="{{ $transaction->customer->user->getAvatar() }}" alt="Customer Avatar" class="w-100" style="object-fit: cover; height: 200px;">
                <div class="card-body bg-light">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td class="text-center"><i class="fas {{ $transaction->customer->gender == 'Male' ? 'fa-male' : 'fa-female' }} text-secondary"></i></td>
                            <td>{{ $transaction->customer->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fas fa-user-md text-secondary"></i></td>
                            <td>{{ $transaction->customer->job }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fas fa-birthday-cake text-secondary"></i></td>
                            <td>{{ $transaction->customer->birthdate }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><i class="fas fa-map-marker-alt text-secondary"></i></td>
                            <td>{{ $transaction->customer->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
    }

    .btn-success {
        background-color:rgb(25, 228, 130);
        border-color: #b21f1f;
    }

    .btn-success:hover {
        background-color:rgb(16, 212, 29);
        border-color: #8a1414;
    }

    .card:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .table td {
        vertical-align: middle;
    }
</style>

<script>
    $('#payment').on('input', function () {
        let val = parseFloat($(this).val().replace(/[^0-9.]/g, ''));
        if (!isNaN(val)) {
            let formatted = '₱ ' + val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            $('#showPaymentType').text(formatted);
        } else {
            $('#showPaymentType').text('');
        }
    });
</script>
@endsection

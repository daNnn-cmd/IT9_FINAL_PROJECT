@extends('template.master')

@section('title', 'Early Checkout')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">Early Checkout for Reservation #{{ $transaction->id }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transaction.early_checkout', $transaction->id) }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="new_checkout" class="form-label fw-semibold text-dark">New Check-out Date</label>
                            <input type="date" id="new_checkout" name="new_checkout"
    class="form-control"
    value="{{ old('new_checkout', $transaction->check_out->format('Y-m-d')) }}"
    max="{{ $transaction->check_out->format('Y-m-d') }}"
    required>

                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning text-white shadow-sm">
                                <i class="fas fa-calendar-check me-1"></i> Confirm Early Checkout
                            </button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
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

    .text-dark-blue {
        color: #1a2a6c;
    }

    .btn-warning {
        background-color:rgb(1, 7, 112);
        border-color: #eea236;
    }

    .btn-warning:hover {
        background-color:rgb(3, 0, 162);
        border-color:rgb(0, 12, 122);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
    }
</style>
@endsection

@extends('template.master')

@section('title', 'Extend Stay')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <h4 class="mb-0">Extend Stay for Reservation #{{ $transaction->id }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transaction.extend', $transaction->id) }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="new_checkout" class="form-label fw-semibold text-dark">New Check-out Date</label>
                            <input type="date" id="new_checkout" name="new_checkout"
    class="form-control"
    value="{{ old('new_checkout', $transaction->check_out->format('Y-m-d')) }}"
    min="{{ $transaction->check_out->format('Y-m-d') }}"
    required>



                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="fas fa-calendar-plus me-1"></i> Extend Stay
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

    .btn-primary {
        background-color:rgb(205, 209, 223);
        border-color: #1a2a6c;
    }

    .btn-primary:hover {
        background-color:rgb(25, 227, 22);
        border-color: #151e50;
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

@extends('template.master')

@section('title', 'Customer Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                    <h2 class="fw-bold mb-0">Customer Details</h2>
                </div>
                <div class="card-body p-5 bg-light">
                    <div class="row align-items-center">
                        <!-- Avatar -->
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img src="{{ $customer->user->getAvatar() }}"
                                 class="rounded-circle border border-3 shadow-sm"
                                 alt="Customer Avatar"
                                 style="width: 180px; height: 180px; object-fit: cover; border-color: #1a2a6c;">
                        </div>
                        <!-- Info -->
                        <div class="col-md-8">
                            <h3 class="fw-bold text-dark">{{ $customer->name }}</h3>
                            <hr class="my-3">
                            <p class="mb-2"><span class="fw-semibold text-dark">Job:</span> {{ $customer->job }}</p>
                            <p class="mb-2"><span class="fw-semibold text-dark">Address:</span> {{ $customer->address }}</p>
                            <p class="mb-2"><span class="fw-semibold text-dark">Email:</span> {{ $customer->user->email }}</p>
                            <p class="mb-0"><span class="fw-semibold text-dark">Date of Birth:</span> {{ \Carbon\Carbon::parse($customer->birthdate)->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

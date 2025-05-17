@extends('template.master')

@section('title', 'User')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                    <h2 class="fw-bold mb-0">User Details</h2>
                </div>
                <div class="card-body p-5 bg-light">
                    <div class="row g-0 align-items-center rounded-3">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img src="{{ $user->getAvatar() }}" class="img-fluid rounded-circle border border-4 shadow" alt="User Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8 ps-md-4">
                            <h4 class="fw-bold text-dark mb-3">{{ $user->name }}</h4>
                            <p class="mb-2"><strong class="text-dark">Email:</strong> <span class="text-muted">{{ $user->email }}</span></p>
                            <p class="mb-0"><strong class="text-dark">Role:</strong> 
                                <span class="badge rounded-pill px-3 py-2 text-white" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                                    {{ $user->role }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection

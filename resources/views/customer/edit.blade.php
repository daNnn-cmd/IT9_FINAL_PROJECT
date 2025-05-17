@extends('template.master')

@section('title', 'Edit Customer')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                    <h2 class="fw-bold mb-0">Edit Customer</h2>
                </div>
                <div class="card-body p-5 bg-light">
                    <form class="row g-4" method="POST" action="{{ route('customer.update', ['customer' => $customer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <!-- Name -->
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ $customer->name }}" placeholder="Enter full name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email (disabled) -->
                        <div class="col-md-12">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control rounded-3" id="email" value="{{ $customer->user->email }}" disabled>
                            <small class="text-muted">Email cannot be changed.</small>
                        </div>

                        <!-- Birthdate -->
                        <div class="col-md-12">
                            <label for="birthdate" class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" class="form-control rounded-3 @error('birthdate') is-invalid @enderror"
                                   id="birthdate" name="birthdate" value="{{ $customer->birthdate }}">
                            @error('birthdate')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-md-12">
                            <label for="gender" class="form-label fw-semibold">Gender</label>
                            <select class="form-select rounded-3 @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option disabled hidden>Choose gender...</option>
                                <option value="Male" {{ $customer->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $customer->gender === 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Job -->
                        <div class="col-md-12">
                            <label for="job" class="form-label fw-semibold">Occupation</label>
                            <input type="text" class="form-control rounded-3 @error('job') is-invalid @enderror"
                                   id="job" name="job" value="{{ $customer->job }}" placeholder="Customer's job">
                            @error('job')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-12">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <textarea class="form-control rounded-3 @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="3" placeholder="Complete address">{{ $customer->address }}</textarea>
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Avatar -->
                        <div class="col-md-12">
                            <label for="avatar" class="form-label fw-semibold">Profile Picture</label>
                            <input class="form-control rounded-3 @error('avatar') is-invalid @enderror" type="file" id="avatar" name="avatar">
                            @error('avatar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn text-white px-4 py-2 shadow-sm fw-semibold"
                                    style="background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));
">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

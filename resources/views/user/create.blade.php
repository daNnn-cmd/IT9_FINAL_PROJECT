@extends('template.master')

@section('title', 'Add User')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                    <h2 class="fw-bold mb-0">Add New User</h2>
                </div>
                <div class="card-body px-5 py-4 bg-light">
                    <form class="row g-4" method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
    <label for="email" class="form-label fw-semibold">Email Address</label>
    <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror"
           id="email" name="email" value="" autocomplete="off">
    @error('email')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6">
    <label for="password" class="form-label fw-semibold">Password</label>
    <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror"
           id="password" name="password" autocomplete="new-password">
    @error('password')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

                        <div class="col-md-12">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select id="role" name="role" class="form-select rounded-3 @error('role') is-invalid @enderror">
                                <option selected disabled hidden>Choose a role...</option>
                                <option value="Super" @if (old('role') == 'Super') selected @endif>Super</option>
                                <option value="Admin" @if (old('role') == 'Admin') selected @endif>Admin</option>
                            </select>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end mt-3">
                            <button type="submit" class="btn px-4 py-2 text-white fw-semibold shadow-sm" style="background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77)); border: none; border-radius: 12px;">
                                <i class="bi bi-person-plus-fill me-2"></i>Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

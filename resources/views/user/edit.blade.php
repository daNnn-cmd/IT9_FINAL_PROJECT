@extends('template.master')

@section('title', 'Edit User')

@section('content')
@if ($errors->any())
    <div class="container mb-4">
        <div class="alert alert-danger shadow-sm rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header text-white py-4" style="background: linear-gradient(to right, #1a2a6c, #b21f1f);">
                    <h3 class="mb-0 fw-bold text-center"><i class="fas fa-user-edit me-2"></i>Edit User</h3>
                </div>
                <div class="card-body px-5 py-4 bg-light">
                    <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="example@email.com">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <select id="role" name="role" class="form-select rounded-3 @error('role') is-invalid @enderror">
                                <option disabled hidden {{ old('role', $user->role) ? '' : 'selected' }}>Choose a role...</option>
                                @foreach (['Super', 'Admin'] as $roleOption)
                                    <option value="{{ $roleOption }}" 
                                            {{ old('role', $user->role) === $roleOption ? 'selected' : '' }}>
                                        {{ $roleOption }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn text-white fw-semibold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));
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

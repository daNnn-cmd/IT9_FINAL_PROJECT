@extends('template.master')

@section('title', 'Create Identity')

@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        body {
            background-color:rgb(226, 223, 231);
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(to right, #1a2a6c, #b21f1f);
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            padding: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #343a40;
        }
        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .btn-primary {
            background-color:rgb(185, 192, 217);
            border-color:rgb(207, 211, 226);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #b21f1f;
            border-color: #b21f1f;
        }
    </style>
@endsection

@section('content')
    @include('transaction.reservation.progressbar')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">Add Customer</div>
                    <div class="card-body p-5">
                        <form class="row g-4" method="POST" action="{{ route('transaction.reservation.storeCustomer') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}">
                                @error('birthdate')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Job</label>
                                <input type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') }}">
                                @error('job')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
                                @error('address')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Profile Picture</label>
                                <input class="form-control" type="file" name="avatar">
                                @error('avatar')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary shadow">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

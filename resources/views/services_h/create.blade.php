@extends('template.master')
@section('title', 'Services')

@section('content')
<style>
    .hotel-form-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .hotel-form-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: #fff;
        padding: 1.75rem;
        font-size: 1.25rem;
        font-weight: 600;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .hotel-form-body {
        padding: 2rem;
    }

    .hotel-form-group label {
        font-weight: 600;
        color: #1a2a6c;
    }

    .hotel-form-group input,
    .hotel-form-group textarea {
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .hotel-form-group input:focus,
    .hotel-form-group textarea:focus {
        border-color: #1a2a6c;
        box-shadow: 0 0 0 0.2rem rgba(26, 42, 108, 0.15);
    }

    .btn-hotel-save {
        background: #1a2a6c;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: 0.3s ease;
    }

    .btn-hotel-save:hover {
        background: #151e4d;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .btn-hotel-save i {
        margin-right: 0.5rem;
    }
</style>

<div class="hotel-form-card">
    <div class="hotel-form-header">
        {{ isset($services_h) ? 'Edit Service' : 'Add Service' }}
    </div>
    <div class="hotel-form-body">
        <form action="{{ isset($services_h) ? route('services_h.update', $services_h->id) : route('services_h.store') }}" method="POST">
            @csrf
            @if(isset($services_h))
                @method('PUT')
            @endif

            <div class="hotel-form-group mb-4">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name', $services_h->name ?? '') }}" required>
            </div>

            <div class="hotel-form-group mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"
                          placeholder="Enter service description...">{{ old('description', $services_h->description ?? '') }}</textarea>
            </div>

            <div class="hotel-form-group mb-4">
                <label for="price" class="form-label">Price (₱)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                       value="{{ old('price', $services_h->price ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-hotel-save">
                <i class="fas fa-save"></i>Save
            </button>
        </form>
    </div>
</div>
@endsection

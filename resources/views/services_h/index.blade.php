@extends('template.master')
@section('title', 'Services')

@section('content')
<style>
    .hotel-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .hotel-card-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        padding: 1.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .hotel-card-header h5 {
        margin: 0;
        font-size: 1.4rem;
        font-weight: bold;
    }

    .btn-hotel-add {
        background: white;
        color: #1a2a6c;
        border: 2px solid #1a2a6c;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        font-weight: 600;
        transition: 0.3s ease;
        display: inline-flex;
        align-items: center;
    }

    .btn-hotel-add:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        color: #b21f1f;
        border-color: #b21f1f;
    }

    .btn-hotel-add i {
        margin-right: 0.5rem;
    }

    .hotel-table {
        width: 100%;
        margin-top: 1.25rem;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .hotel-table thead {
        background-color: rgba(26, 42, 108, 0.08);
    }

    .hotel-table thead th {
        color: #1a2a6c;
        font-weight: 700;
        padding: 1rem;
        font-size: 1rem;
        border-bottom: 2px solid rgba(26, 42, 108, 0.1);
    }

    .hotel-table tbody tr {
        background-color: #fdfdfd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
    }

    .hotel-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        font-size: 0.95rem;
        border-bottom: none;
    }

    .hotel-table tbody tr:hover {
        background-color: rgba(26, 42, 108, 0.03);
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.45rem 0.65rem;
        border-radius: 8px;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        color: white;
    }
</style>

<div class="hotel-card mb-4">
    <div class="hotel-card-header">
        <h5><i class="fas fa-utensils"></i> Hotel Services</h5>
        <a href="{{ route('services_h.create') }}" class="btn btn-hotel-add">
            <i class="fas fa-plus"></i>Add Service
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table hotel-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>₱{{ number_format($service->price, 2) }}</td>
                        <td>
                            <a href="{{ route('services_h.edit', $service->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('services_h.destroy', $service->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($services->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No services available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

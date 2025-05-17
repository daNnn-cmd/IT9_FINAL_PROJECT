@extends('template.master')
@section('title', 'Customer Management')
@section('head')
<style>
    :root {
        --hotel-primary:rgb(92, 122, 246);
        --hotel-secondary:rgb(80, 111, 234);
        --hotel-light: #f9f5f0;
        --hotel-dark: #0d1b2a;
        --hotel-accent: #9b2226;
        --hotel-success: #28a745;
        --hotel-danger: #dc3545;
    }
    
    .customer-management {
        background-color:rgb(234, 232, 232);
        padding: 2rem 0;
        font-family: 'Montserrat', sans-serif;
    }
    
    .customer-header {
        background: linear-gradient(135deg, var(--hotel-primary), var(--hotel-dark));
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .customer-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        background: white;
        height: 100%;
        position: relative;
    }
    
    .customer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }
    
    .customer-number {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--hotel-primary);
        color: white;
        font-weight: bold;
        border-radius: 8px;
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }
    
    .customer-avatar {
        height: 180px;
        overflow: hidden;
        position: relative;
    }
    
    .customer-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .customer-card:hover .customer-avatar img {
        transform: scale(1.05);
    }
    
    .customer-actions {
        position: absolute;
        right: 15px;
        top: 15px;
        z-index: 2;
    }
    
    .action-btn {
        background: white;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        color: var(--hotel-dark);
        transition: all 0.3s;
        border: none;
    }
    
    .action-btn:hover {
        background: var(--hotel-secondary);
        color: white;
    }
    
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 0.5rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        transition: all 0.2s;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .dropdown-item:hover {
        background-color: var(--hotel-light);
        color: var(--hotel-primary);
    }
    
    .hotel-btn {
        background-color: var(--hotel-primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    
    .hotel-btn:hover {
        background-color: var(--hotel-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .search-btn {
        background-color: var(--hotel-secondary);
        color: var(--hotel-dark);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        transition: all 0.3s;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .search-btn:hover {
        background-color: #d4a657;
        color: var(--hotel-dark);
    }
    
    .search-input {
        border: 1px solid rgba(26, 62, 114, 0.15);
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s;
    }
    
    .search-input:focus {
        border-color: var(--hotel-secondary);
        box-shadow: 0 0 0 0.25rem rgba(232, 192, 125, 0.25);
    }
    
    .customer-name {
        color: var(--hotel-primary);
        font-weight: 600;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .customer-info {
        padding: 1.25rem;
    }
    
    .info-item {
        display: flex;
        margin-bottom: 0.75rem;
        align-items: flex-start;
    }
    
    .info-icon {
        color: var(--hotel-secondary);
        width: 20px;
        text-align: center;
        margin-right: 10px;
        font-size: 0.9rem;
        margin-top: 2px;
    }
    
    .info-text {
        color: #6c757d;
        font-size: 0.9rem;
        flex: 1;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: var(--hotel-dark);
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .empty-icon {
        font-size: 3.5rem;
        color: var(--hotel-secondary);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }
    
    .badge-count {
        background: white;
        color: var(--hotel-primary);
        border-radius: 50px;
        padding: 0.25rem 0.75rem;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    @media (max-width: 767.98px) {
        .customer-avatar {
            height: 150px;
        }
        
        .customer-info {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="customer-management">
    <div class="container">
        <!-- Header Section -->
        <div class="customer-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0"><i class="fas fa-users me-2"></i>Customer Management</h1>
                <div>
                    <span class="badge-count">
                        {{ $customers->total() }} Customers
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Search and Add Customer Section -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <form class="d-flex" method="GET" action="{{ route('customer.index') }}">
                    <input class="form-control search-input me-2" type="search" 
                           placeholder="Search by name..." aria-label="Search" 
                           id="search" name="search" value="{{ request()->input('search') }}">
                    <button class="btn search-btn" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('customer.create') }}" class="hotel-btn">
                    <i class="fas fa-user-plus"></i> Add Customer
                </a>
            </div>
        </div>
        
        <!-- Customer Cards -->
<div class="row">
    @forelse ($customers as $customer)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="customer-card">
                <div class="customer-number">
                    {{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->index + 1 }}
                </div>

                <div class="customer-avatar">
                    <img src="{{ $customer->user->getAvatar() }}" alt="{{ $customer->name }}">
                </div>

                <div class="customer-actions">
                    <div class="dropdown">
                        <button class="action-btn" type="button" id="dropdownMenuButton{{ $customer->id }}" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $customer->id }}">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.show', ['customer' => $customer->id]) }}">
                                    <i class="fas fa-eye"></i> Details
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.edit', ['customer' => $customer->id]) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </li>

                            <li>
                                <form method="POST" id="delete-customer-form-{{ $customer->id }}"
                                      action="{{ route('customer.destroy', ['customer' => $customer->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="dropdown-item delete" href="#" 
                                       onclick="event.preventDefault(); document.getElementById('delete-customer-form-{{ $customer->id }}').submit();"
                                       customer-id="{{ $customer->id }}" customer-role="Customer" 
                                       customer-name="{{ $customer->name }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="customer-info">
                    <h5 class="customer-name">{{ $customer->name }}</h5>
                    <div class="info-item">
                        <span class="info-icon"><i class="fas fa-envelope"></i></span>
                        <span class="info-text">{{ $customer->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon"><i class="fas fa-briefcase"></i></span>
                        <span class="info-text">{{ $customer->job ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="info-text">{{ $customer->address ?? 'Not specified' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon"><i class="fas fa-birthday-cake"></i></span>
                        <span class="info-text">{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('d M Y') : 'Not specified' }}</span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <i class="fas fa-users-slash empty-icon"></i>
                <h4>No Customers Found</h4>
                <p class="mb-4">There are no customers in the database. Add a new customer to get started.</p>
                <a href="{{ route('customer.create') }}" class="hotel-btn">
                    <i class="fas fa-plus"></i> Add Customer
                </a>
            </div>
        </div>
    @endforelse
    
</div>
        <!-- Pagination -->
        @if($customers->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $customers->onEachSide(2)->links('template.paginationlinks') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
    $('.delete-customer').click(function(e) {
        e.preventDefault();
        var customerId = $(this).data('id');
        var customerName = $(this).data('name');

        // Show a confirmation dialog
        Swal.fire({
            title: 'Confirm Deletion',
            html: `<p>You are about to delete <strong>${customerName}</strong>.</p><p>This action cannot be undone.</p>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--hotel-primary)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash me-1"></i> Delete',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Cancel',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the customer
                $.ajax({
                    url: `/customer/${customerId}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Success - Show message and remove the customer row
                        Swal.fire('Deleted!', response.message, 'success');
                        $(`#customer-row-${customerId}`).fadeOut(500, function() { $(this).remove(); });
                    },
                    error: function(xhr) {
                        // Error - Show error message
                        Swal.fire('Error!', xhr.responseJSON.message, 'error');
                    }
                });
            }
        });
    });
});

</script>
@endsection
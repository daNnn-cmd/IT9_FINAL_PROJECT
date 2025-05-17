@extends('template.master')
@section('title', 'Reservation Management')
@section('content')
<style>
    /* Hotel Theme Styles */
    .hotel-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hotel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .hotel-btn {
       background: linear-gradient(135deg,rgb(0, 0, 84),rgb(37, 0, 77));
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }
    
    .hotel-btn:hover {
       color: #ffffff; /* or any color you prefer */
    background-color: var(--primary-color); /* optional */
    transform: translateY(-3px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }
    
    .hotel-btn-outline {
        border: 1px solid #1a2a6c;
        color: #1a2a6c;
        background: white;
    }
    
    .hotel-btn-outline:hover {
        background: #1a2a6c;
        color: white;
    }
    
    .hotel-table {
        border-collapse: separate;
        color: purple;
        border-spacing: 0 8px;
    }
    
    .hotel-table thead th {
        background: #1a2a6c;
        color: white;
        border: none;
        padding: 12px 15px;
    }
    
    .hotel-table tbody tr {
        background: purple;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
    }
    
    .hotel-table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .hotel-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-active {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }
    
    .badge-expired {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    
    .hotel-search {
        border: 1px solid rgba(26, 42, 108, 0.3);
        border-radius: 8px;
        padding-left: 15px;
    }
    
    .hotel-search:focus {
        border-color: #1a2a6c;
        box-shadow: 0 0 0 0.25rem rgba(26, 42, 108, 0.25);
    }
    
    .section-title {
        color: #1a2a6c;
        font-weight: 600;
        border-left: 4px solid #b21f1f;
        padding-left: 10px;
        margin-bottom: 20px;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
    }
    
    .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        border-bottom: none;
    }
    
    .btn-close {
        filter: invert(1);
    }
    
    /* Pagination Styles */
    .hotel-pagination .page-item .page-link {
        color: #1a2a6c;
        border-radius: 8px;
        margin: 0 3px;
        border: 1px solid rgba(26, 42, 108, 0.2);
        padding: 8px 15px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .hotel-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        border-color: transparent;
        color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .hotel-pagination .page-item .page-link:hover {
        background-color: rgba(26, 42, 108, 0.1);
        transform: translateY(-2px);
    }
    
    .hotel-pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }
</style>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold text-dark"><i class="fas fa-calendar-check me-2"></i>Reservation Management</h3>
                <div class="d-flex">
                    <form class="d-flex me-3" method="GET" action="{{ route('transaction.index') }}">
                        <div class="input-group">
                            <input class="form-control hotel-search" type="search" placeholder="Search by ID..." 
                                id="search-user" name="search" value="{{ request()->input('search') }}">
                            <button class="btn hotel-btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="btn-group">
                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="New Reservation">
                            <button type="button" class="btn hotel-btn me-2" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="fas fa-plus me-2"></i>New Booking
                            </button>
                        </span>
                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Payment History">
                            <a href="{{route('payment.index')}}" class="btn hotel-btn-outline">
                                <i class="fas fa-history me-2"></i>Payments
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Guests Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="section-title text-dark-blue mb-3">Active Guests</h5>
            <div class="card hotel-card border-light">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table hotel-table">
                            <thead class="bg-light-blue text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Reservation ID</th>
                                    <th>Guest Name</th>
                                    <th>Room</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Duration</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr class="border-bottom border-light">
                                        <td class="text-secondary">{{ ($transactions->currentpage() - 1) * $transactions->perpage() + $loop->index + 1 }}</td>
                                        <td><strong class="text-dark-blue">#{{ $transaction->id }}</strong></td>
                                        <td class="text-dark">{{ $transaction->customer->name }}</td>
                                        <td>
                                            <span class="badge hotel-badge" style="background: #e8f0fe; color: #1a2a6c; border: 1px solid #d0d9f0;">
                                                {{ $transaction->room->number }}
                                            </span>
                                        </td>
                                        <td class="text-dark">{{ Helper::dateFormat($transaction->check_in) }}</td>
                                        <td class="text-dark">{{ Helper::dateFormat($transaction->check_out) }}</td>
                                        <td class="text-secondary">{{ $transaction->getDateDifferenceWithPlural($transaction->check_in, $transaction->check_out) }}</td>
                                        <td><strong class="text-dark">{{ Helper::convertToPesos($transaction->getTotalPrice()) }}</strong></td>
                                        <td class="text-success">{{ Helper::convertToPesos($transaction->getTotalPayment()) }}</td>
                                        <td>
                                            @if($transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0)
                                                <span class="badge hotel-badge bg-success-light text-success">Paid</span>
                                            @else
                                                <strong class="text-danger">{{ Helper::convertToPesos($transaction->getTotalPrice() - $transaction->getTotalPayment()) }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge hotel-badge bg-active-light text-active">
                                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i> Active
                                            </span>
                                        </td>
                                        <td class="d-flex flex-wrap gap-1">
    @if($transaction->getTotalPrice() - $transaction->getTotalPayment() > 0)
        <a class="action-btn btn-success bg-success"
            href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
            data-bs-toggle="tooltip" title="Receive Payment">
            <i class="fas fa-money-bill-wave-alt text-white"></i>
        </a>
    @else
        <span class="action-btn btn-secondary bg-secondary-light text-secondary"
              data-bs-toggle="tooltip" title="Fully Paid">
            <i class="fas fa-check-circle"></i>
        </span>
    @endif

    @if($transaction->getTotalPrice() - $transaction->getTotalPayment() <= 0)
        <!-- Extend Accommodation -->
        <a href="{{ route('transaction.extend', ['transaction' => $transaction->id]) }}"
            class="action-btn bg-primary text-white"
            data-bs-toggle="tooltip" title="Extend Stay">
            <i class="fas fa-calendar-plus"></i>
        </a>

        <!-- Early Checkout -->
        <a href="{{ route('transaction.early_checkout', ['transaction' => $transaction->id]) }}"
            class="action-btn bg-warning text-black"
            data-bs-toggle="tooltip" title="Early Checkout">
            <i class="fas fa-calendar-minus"></i>
        </a>
    @else
        <!-- Disabled Buttons if Not Fully Paid -->
        <span class="action-btn bg-secondary-light text-muted" data-bs-toggle="tooltip" title="Settle balance to extend stay">
            <i class="fas fa-calendar-plus"></i>
        </span>
        <span class="action-btn bg-secondary-light text-muted" data-bs-toggle="tooltip" title="Settle balance to checkout early">
            <i class="fas fa-calendar-minus"></i>
        </span>
    @endif
</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center py-4 bg-light">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-bed fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No active reservations found</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination (Client-Side) -->
<div class="d-flex justify-content-between align-items-center px-4 py-3 bg-white border-top mt-3">
    <div class="text-muted" id="paginationText">
        Showing <span class="fw-semibold" id="firstItem">0</span> to 
        <span class="fw-semibold" id="lastItem">0</span> of 
        <span class="fw-semibold" id="totalItems">0</span> entries
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination hotel-pagination mb-0" id="paginationControls">
            <li class="page-item disabled" id="prevBtn">
                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
            </li>
            <li class="page-item disabled" id="nextBtn">
                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
            </li>
        </ul>
    </nav>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- New Reservation Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-door-open me-2"></i>New Room Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <h5 class="mb-4">Does the guest have an existing account?</h5>
                <div class="d-flex justify-content-center gap-3">
                    <a class="btn hotel-btn-outline py-3 px-4 d-flex flex-column align-items-center" 
                       href="{{ route('transaction.reservation.createIdentity') }}">
                        <i class="fas fa-user-plus fa-2x mb-2"></i>
                        <span>New Guest</span>
                    </a>
                    <a class="btn hotel-btn py-3 px-4 d-flex flex-column align-items-center" 
                       href="{{ route('transaction.reservation.pickFromCustomer') }}">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <span>Existing Guest</span>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    :root {
        --dark-blue: #1a2a6c;
        --light-blue: #3a4a8c;
        --active-color: #28a745;
        --active-light: #e6f7eb;
        --success-light: #e6f7eb;
        --secondary-light: #f8f9fa;
    }
    
    .text-dark-blue {
        color: var(--dark-blue);
    }
    
    .bg-light-blue {
        background-color: var(--light-blue);
    }
    
    .bg-active-light {
        background-color: var(--active-light);
    }
    
    .text-active {
        color: var(--active-color);
    }
    
    .bg-success-light {
        background-color: var(--success-light);
    }
    
    .bg-secondary-light {
        background-color: var(--secondary-light);
    }
    
    .hotel-card {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
    }
    
    .hotel-table {
        font-size: 0.9rem;
    }
    
    .hotel-table th {
        font-weight: 600;
        padding: 12px 15px;
    }
    
    .hotel-table td {
        padding: 10px 15px;
        vertical-align: middle;
    }
    
    .hotel-badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
</style>

@endsection

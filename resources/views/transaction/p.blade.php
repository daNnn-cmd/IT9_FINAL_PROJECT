@extends('template.master')
@section('title', 'Reservation Management')
@section('content')

<style>
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
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }
    .hotel-btn:hover {
        background: linear-gradient(135deg, #b21f1f, #1a2a6c);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold text-dark">
                    <i class="fas fa-calendar-check me-2"></i>Past Reservation Management
                </h3>

                <div class="d-flex">
    <form class="d-flex me-3" method="GET" action="{{ route('transaction.p') }}">
        <div class="input-group">
            <input class="form-control hotel-search" 
                   type="search" 
                   placeholder="Search by ID..." 
                   id="search-user" 
                   name="search" 
                   value="{{ request()->input('search') }}">
            <button class="btn hotel-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <div class="btn-group">
        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Payment History">
            <a href="{{ route('payment.index') }}" class="btn hotel-btn-outline">
                <i class="fas fa-history me-2"></i>Payments
            </a>
        </span>
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Past Reservations Table -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="section-title text-dark-blue mb-3">Past Reservations</h5>

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
                                @forelse ($transactionsExpired as $transaction)
                                    <tr class="border-bottom border-light">
                                        <td class="text-secondary">{{ ($transactionsExpired->currentpage() - 1) * $transactionsExpired->perpage() + $loop->index + 1 }}</td>
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
                                                <strong class="text-danger">{{ Helper::convertToPesos($transaction->getTotalPrice($transaction->room->price, $transaction->check_in, $transaction->check_out) - $transaction->getTotalPayment()) }}</strong>
                                            @endif
                                        </td>
                                        <td>
    @if($transaction->getTotalPrice() - $transaction->getTotalPayment() > 0)
        <span class="badge hotel-badge bg-warning text-dark">
            <i class="fas fa-circle me-1" style="font-size: 8px;"></i> Pending
        </span>
    @else
        <span class="badge hotel-badge bg-success-light text-dark">
            <i class="fas fa-circle me-1" style="font-size: 8px;"></i> Completed
        </span>
    @endif
</td>

                                        <td>
                                            @if($transaction->getTotalPrice() - $transaction->getTotalPayment() > 0)
                                                <a class="action-btn btn-warning bg-warning" 
                                                   href="{{ route('transaction.payment.create', ['transaction' => $transaction->id]) }}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Collect Balance">
                                                    <i class="fas fa-money-bill-wave-alt text-black"></i>
                                                </a>
                                            @else
                                                <span class="action-btn btn-secondary bg-secondary-light text-secondary" 
                                                      data-bs-toggle="tooltip" data-bs-placement="top" title="Fully Paid">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center py-4 bg-light">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No past reservations found</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-white border-top">
                            <div class="text-muted">
                                Showing <span class="fw-semibold">{{ $transactionsExpired->firstItem() ?? 0 }}</span> to 
                                <span class="fw-semibold">{{ $transactionsExpired->lastItem() ?? 0 }}</span> of 
                                <span class="fw-semibold">{{ $transactionsExpired->total() }}</span> entries
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination hotel-pagination mb-0">
                                    {{-- Previous --}}
                                    @if ($transactionsExpired->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $transactionsExpired->previousPageUrl() }}" rel="prev">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination --}}
                                    @foreach ($transactionsExpired->getUrlRange(1, $transactionsExpired->lastPage()) as $page => $url)
                                        @if ($page == $transactionsExpired->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next --}}
                                    @if ($transactionsExpired->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $transactionsExpired->nextPageUrl() }}" rel="next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    
                    </div> 
                </div>
            </div> 
        </div>
    </div> 

</div> 

<!-- ================== EXTRA CSS ================== -->
<style>
    :root {
        --expired-color: #6c757d;
        --expired-light: #f8f9fa;
        --warning-color: #ffc107;
        --dark-blue: #1a2a6c;
        --light-blue: #1a2a6c;
        --success-light: rgba(40, 167, 69, 0.2);
        --secondary-light: rgba(108, 117, 125, 0.2);
    }

    .bg-expired-light { background-color: var(--expired-light); }
    .text-expired { color: var(--expired-color); }
    .bg-warning { background-color: var(--warning-color); }
    .text-dark-blue { color: var(--dark-blue); }
    .bg-light-blue { background-color: var(--light-blue); }
    .bg-success-light { background-color: var(--success-light); }
    .bg-secondary-light { background-color: var(--secondary-light); }
</style>

@endsection

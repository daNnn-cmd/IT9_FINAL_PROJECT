@extends('template.master')
@section('title', 'Payment History')
@section('content')
<style>
    .hotel-payment-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .hotel-payment-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        padding: 1rem 1.5rem;
        border-bottom: none;
    }
    
    .hotel-payment-table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    
    .hotel-payment-table thead th {
        background: #f8f9fa;
        color: #1a2a6c;
        font-weight: 600;
        border: none;
        padding: 12px 16px;
    }
    
    .hotel-payment-table tbody tr {
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border-radius: 8px;
    }
    
    .hotel-payment-table tbody td {
        padding: 12px 16px;
        vertical-align: middle;
        border-top: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .hotel-payment-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-paid {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
    }
    
    .badge-pending {
        background: rgba(255, 193, 7, 0.15);
        color:rgb(130, 98, 0);
    }
    
    .hotel-invoice-btn {
        background: rgba(26, 42, 108, 0.1);
        color: #1a2a6c;
        border: none;
        border-radius: 6px;
        padding: 6px 12px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .hotel-invoice-btn:hover {
        background: #1a2a6c;
        color: white;
        transform: translateY(-1px);
    }
    
    .empty-state {
        padding: 2rem;
        text-align: center;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 2.5rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.4rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
}

.hotel-pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .hotel-pagination .page-item {
        margin: 0 0.25rem;
    }
    
    .hotel-pagination .page-item.active .page-link {
        background: #1a2a6c;
        border-color: #1a2a6c;
        color: white;
    }
    
    .hotel-pagination .page-link {
        color: #1a2a6c;
        border-radius: 8px;
        border: 1px solid rgba(26, 42, 108, 0.1);
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }
    
    .hotel-pagination .page-link:hover {
        background: rgba(26, 42, 108, 0.1);
    }
    .hotel-invoice-btn {
    text-decoration: none;
}


</style>

<div class="container-fluid">
    <div class="hotel-payment-card">
        <div class="hotel-payment-header">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Payment History</h5>
        </div>
        <div class="card-body">
            <!-- Items Per Page Selector -->
            <div class="row mb-3">
                <div class="col-md-2">
                    
                </div>
            </div>

            <div class="table-responsive">
                <table class="table hotel-payment-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Served By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <th scope="row">{{ ($payments->currentpage() - 1) * $payments->perpage() + $loop->index + 1 }}</th>
                                <td>
                                    <span class="badge" style="background: rgba(26, 42, 108, 0.1); color: #1a2a6c;">
                                        {{ $payment->transaction->room->number }}
                                    </span>
                                </td>
                                <td class="fw-bold">{{ Helper::convertToPesos($payment->price) }}</td>
                                <td>
                                    <span class="hotel-payment-badge {{ $payment->status == 'Paid' ? 'badge-paid' : 'badge-pending' }}">
                                        {{ $payment->status }}
                                    </span>
                                </td>
                                <td>{{ Helper::dateFormatTime($payment->created_at) }}</td>
                                <td>{{ $payment->user->name }}</td>
                                <td>
                                    <a href="{{ route('payment.invoice', $payment->id) }}" class="hotel-invoice-btn">
                                        <i class="fas fa-file-invoice me-1"></i> Invoice
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <h5>No Payment Records Found</h5>
                                        <p class="mb-0">No payment transactions have been recorded yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

           <!-- Pagination -->
@if($payments->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="pagination-info">
            Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ $payments->total() }} entries
        </div>

        <div class="hotel-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Link -->
                    @if ($payments->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $payments->appends(request()->query())->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    <!-- Pagination Numbers -->
                    @for ($i = 1; $i <= $payments->lastPage(); $i++)
                        <li class="page-item {{ $i == $payments->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $payments->appends(request()->query())->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next Link -->
                    @if ($payments->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $payments->appends(request()->query())->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif

        </div>
    </div>
</div>
@endsection
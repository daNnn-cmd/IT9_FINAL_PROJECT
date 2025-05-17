@extends('template.master')
@section('title', 'User Activity Log')
@section('content')
<style>
    .hotel-activity-log {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }
    
    .hotel-log-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .hotel-log-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .hotel-log-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .hotel-log-table thead th {
        background: rgba(26, 42, 108, 0.05);
        color: #1a2a6c;
        font-weight: 600;
        padding: 1rem;
        border: none;
    }
    
    .hotel-log-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .hotel-log-table tbody tr:last-child td {
        border-bottom: none;
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
    
    .hotel-view-all-btn {
        background: #1a2a6c;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .hotel-view-all-btn:hover {
        background: #0f1c4d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    .hotel-view-all-btn i {
        margin-right: 0.5rem;
    }
    
    .system-user {
        color: #6c757d;
        font-style: italic;
    }
    
    .user-name {
        font-weight: 500;
        color: #1a2a6c;
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }
</style>

<div class="hotel-activity-log">
    <div class="container">
        <!-- Header Section -->
        <div class="hotel-log-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0"><i class="fas fa-clipboard-list me-2"></i>User Activity Log</h1>
                <div>
                    <span class="badge bg-white text-primary rounded-pill px-3 py-2">
                        {{ $activities->total() }} Total Activities
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Activity Log Table -->
        <div class="hotel-log-card">
            <div class="table-responsive">
                <table class="hotel-log-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity Description</th>
                            <th>Performed By</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activities as $activity)
                            <tr>
                                <td>{{ ($activities->currentPage() - 1) * $activities->perPage() + $loop->iteration }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>
                                    @if($activity->causer)
                                        <span class="user-name">{{ $activity->causer->name }}</span>
                                    @else
                                        <span class="system-user">System</span>
                                    @endif
                                </td>
                                <td>{{ $activity->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-clipboard"></i>
                                        <h4>No Activity Logs Found</h4>
                                        <p class="mb-0">No user activities have been recorded yet</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($activities->hasPages())
        <div class="hotel-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Link -->
                    @if ($activities->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $activities->previousPageUrl() }}" rel="prev">Previous</a>
                        </li>
                    @endif

                    <!-- Pagination Numbers -->
                    @for ($i = 1; $i <= $activities->lastPage(); $i++)
                        <li class="page-item {{ $i == $activities->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $activities->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next Link -->
                    @if ($activities->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $activities->nextPageUrl() }}" rel="next">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
        
    </div>
</div>
@endsection
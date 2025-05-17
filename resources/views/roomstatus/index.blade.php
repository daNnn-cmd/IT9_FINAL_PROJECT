@extends('template.master')
@section('title', 'Room Status Management')
@section('head')
<style>
    .hotel-roomstatus-container {
        background-color:rgb(255, 255, 255);
        padding: 2rem 0;
    }
    
    .hotel-roomstatus-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .hotel-roomstatus-header {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .hotel-add-btn {
        background: white;
        color: #1a2a6c;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .hotel-add-btn:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .hotel-add-btn svg {
        margin-right: 0.5rem;
        stroke: #1a2a6c;
    }
    
    .hotel-roomstatus-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .hotel-roomstatus-table thead th {
        background: rgba(26, 42, 108, 0.05);
        color: #1a2a6c;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid rgba(26, 42, 108, 0.1);
    }
    
    .hotel-roomstatus-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .hotel-roomstatus-table tbody tr:hover {
        background: rgba(26, 42, 108, 0.02);
    }
    
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-active {
        background: rgba(40, 167, 69, 0.15);
        color: #28a745;
    }
    
    .status-inactive {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        margin: 0 2px;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
    }
    
    .info-text {
        display: -webkit-box;
       
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;
    }
    
    .hotel-roomstatus-footer {
        background: rgba(26, 42, 108, 0.05);
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<div class="hotel-roomstatus-container">
    <div class="container">
        <div class="hotel-roomstatus-card">
            <!-- Header Section -->
            <div class="hotel-roomstatus-header">
                <h3 class="m-0"><i class="fas fa-clipboard-check me-2"></i>Room Status Management</h3>
                <button id="add-button" type="button" class="hotel-add-btn" data-bs-toggle="modal" data-bs-target="#roomStatusModal">
                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Status
                </button>
            </div>
            
            <!-- Table Section -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="roomstatus-table" class="hotel-roomstatus-table">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Status Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>2</td>
                                <td class="fw-semibold">Occupied</td>
                                <td><span class="status-badge status-inactive">OCC</span></td>
                                <td><span class="info-text">Room is currently being used by guests</span></td>
                                <td class="text-center">
                                    <button class="action-btn btn-primary me-1">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="action-btn btn-danger">
                                        <i class="fas fa-trash-alt text-white"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="fw-semibold">Maintenance</td>
                                <td><span class="status-badge status-inactive">MNT</span></td>
                                <td><span class="info-text">Room is under maintenance and not available</span></td>
                                <td class="text-center">
                                    <button class="action-btn btn-primary me-1">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                    <button class="action-btn btn-danger">
                                        <i class="fas fa-trash-alt text-white"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$(document).ready(function() {
    $('#roomstatus-table').DataTable({
        responsive: true,
        dom: '<"top"f>rt<"bottom"lip><"clear">',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search statuses...",
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>'
            }
        },
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control form-control-sm');
        }
    });

    // Add button click handler (implement your modal logic here)
    $('#add-button').click(function() {
        // Your code to show add modal
    });
});
</script>
@endsection
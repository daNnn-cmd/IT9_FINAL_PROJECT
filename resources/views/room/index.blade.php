@extends('template.master')
@section('title', 'Room')
@section('head')
<style>
    .hotel-room-container {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }
    
    .hotel-room-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .hotel-room-header {
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
    
    .hotel-room-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .hotel-room-table thead th {
        background: rgba(26, 42, 108, 0.05);
        color: #1a2a6c;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid rgba(26, 42, 108, 0.1);
    }
    
    .hotel-room-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .hotel-room-table tbody tr:hover {
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
    
    .hotel-room-footer {
        background: rgba(26, 42, 108, 0.05);
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<div class="hotel-room-container">
    <div class="container">
        <div class="hotel-room-card">
            <!-- Header Section -->
            <div class="hotel-room-header">
                <h3 class="m-0"><i class="fas fa-bed me-2"></i>Room Management</h3>
                <button id="add-button" type="button" class="hotel-add-btn" data-bs-toggle="modal" data-bs-target="#roomModal">
                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Room
                </button>
            </div>
            
            <!-- Filter Section -->
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" class="form-select">
                            <option selected>All</option>
                            @forelse ($roomStatuses as $roomStatus)
                                <option value="{{ $roomStatus->id }}">{{ $roomStatus->name }}</option>
                            @empty
                                <option value="">No room status</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="type" class="form-label fw-semibold">Type</label>
                        <select id="type" class="form-select">
                            <option selected>All</option>
                            @forelse ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @empty
                                <option value="">No type</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                
                <hr>
                
                <!-- Room Table Section -->
                <div class="table-responsive">
                    <table id="room-table" class="hotel-room-table">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Type</th>
                                <th>Capacity</th>
                                <th>Price / Day</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
    const roomTable = $('#room-table').DataTable();

    $(document).on('click', '.delete-room-btn', function() {
        const roomId = $(this).data('id');
        const roomNumber = $(this).data('number'); 

        Swal.fire({
            title: 'Confirm Deletion',
            text: `Are you sure you want to delete Room ${roomNumber}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteRoom(roomId, roomNumber);
            }
        });
    });

    function deleteRoom(roomId, roomNumber) {
        $.ajax({
            url: `/rooms/${roomId}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                showToast('success', response.message);
                roomTable.ajax.reload(null, false); 
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'An unexpected error occurred.';
                showToast('error', errorMsg);
            }
        });
    }

    function showToast(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            timer: 2000,
            showConfirmButton: false
        });
    }
});
</script>
@endsection

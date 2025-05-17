@extends('template.master')
@section('title', 'Room Types')
@section('head')
<style>
    .hotel-roomtype-container {
        background-color: #f8f9fa;
        padding: 2rem 0;
    }

    .hotel-roomtype-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .hotel-roomtype-header {
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

    .hotel-roomtype-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .hotel-roomtype-table thead th {
        background: rgba(26, 42, 108, 0.05);
        color: #1a2a6c;
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid rgba(26, 42, 108, 0.1);
    }

    .hotel-roomtype-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .hotel-roomtype-table tbody tr:hover {
        background: rgba(26, 42, 108, 0.02);
    }

    .info-text {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;
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

    .hotel-roomtype-footer {
        background: rgba(26, 42, 108, 0.05);
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

</style>
@endsection

@section('content')
<div class="hotel-roomtype-container">
    <div class="container">
        <div class="hotel-roomtype-card">
            <!-- Header Section -->
            <div class="hotel-roomtype-header">
                <h3 class="m-0"><i class="fas fa-door-open me-2"></i>Room Type Management</h3>
                <button id="add-button" type="button" class="hotel-add-btn">
                    <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Room Type
                </button>
            </div>

            <!-- Table Section -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="type-table" class="hotel-roomtype-table">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Room Type</th>
                                <th>Description</th>
                                <th width="120" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr>
                                <td>1</td>
                                <td class="fw-semibold">Deluxe Room</td>
                                <td><span class="info-text">Spacious room with king-size bed and sea view</span></td>
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
    $('#type-table').DataTable({
        responsive: true,
        dom: '<"top"f>rt<"bottom"lip><"clear">',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search room types...",
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>'
            }
        },
        initComplete: function() {
            $('.dataTables_filter input').addClass('form-control form-control-sm');
        }
    });

    $('#add-button').click(function() {
        // Open modal logic
    });
});
</script>
@endsection

@extends('template.master')
@section('title', 'ChrisDanVan Hotel Dashboard')
@section('content')
    <div id="dashboard" class="py-0.8">
        <!-- Header Section - Modernized with gradient background -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 rounded-lg shadow-lg overflow-hidden">
                    <div class="card-body bg-gradient-primary text-white p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="m-0 fw-bold">ChrisDanVan Hotel Dashboard</h2>
                                <p class="text-white-50 m-0">Welcome to Dashboard</p>
                            </div>
                            <div class="text-end">
                                <h5 class="m-0 fw-bold">{{ count($transactions) }} Guests Today</h5>
                                <p class="m-0 small text-white-50">{{ date('l, F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Today Guests Table Section -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0 font-weight-bold text-primary">Today's Guests</h4>
                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ count($transactions) }} Total</span>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th width="50"></th>
                                    <th>Name</th>
                                    <th>Room</th>
                                    <th>Stay Duration</th>
                                    <th>Remaining</th>
                                    <th>Payment</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <img src="{{ $transaction->customer->user->getAvatar() }}"
                                                class="rounded-circle border" width="40" height="40"
                                                alt="{{ $transaction->customer->name }}">
                                        </td>
                                        <td>
                                            <a href="{{ route('customer.show', ['customer' => $transaction->customer->id]) }}" 
                                               class="text-decoration-none fw-semibold text-primary">
                                                {{ $transaction->customer->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('room.show', ['room' => $transaction->room->id]) }}"
                                               class="badge bg-secondary text-white text-decoration-none">
                                                Room {{ $transaction->room->number }}
                                            </a>
                                        </td>
                                        <td class="small">
                                            <div>{{ Helper::dateFormat($transaction->check_in) }}</div>
                                            <div class="text-muted">to {{ Helper::dateFormat($transaction->check_out) }}</div>
                                        </td>
                                        <td>
                                            @php $daysLeft = Helper::getDateDifference(now(), $transaction->check_out); @endphp
                                            @if($daysLeft == 0)
                                                <span class="badge bg-danger">Last Day</span>
                                            @else
                                                {{ $daysLeft }} {{ Helper::plural('Day', $daysLeft) }}
                                            @endif
                                        </td>
                                        <td>
                                            @php $debt = $transaction->getTotalPrice() - $transaction->getTotalPayment(); @endphp
                                            @if($debt <= 0)
                                                <span class="text-success fw-bold">Paid</span>
                                            @else
                                                <span class="text-danger fw-bold">{{ Helper::convertToPesos($debt) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($debt == 0)
                                                <span class="badge bg-success rounded-pill px-3">Completed</span>
                                            @else
                                                <span class="badge bg-warning text-dark rounded-pill px-3">In Progress</span>
                                                
                                                @if(Helper::getDateDifference(now(), $transaction->check_out) < 1)
                                                    <div class="mt-1">
                                                        <span class="badge bg-danger rounded-pill px-3">
                                                            <i class="fas fa-exclamation-circle me-1"></i> Payment Due
                                                        </span>
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fas fa-bed fa-2x mb-3 d-block"></i>
                                            No guests checked in today
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Statistics & Chart Section -->
            <div class="col-lg-5 mb-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm bg-success text-white h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-uppercase small mb-2">Occupancy Rate</h6>
                                        <h3 class="m-0 fw-bold">78%</h3>
                                    </div>
                                    <div class="rounded-circle bg-white p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px">
                                        <i class="fas fa-bed text-success fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm bg-primary text-white h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="text-uppercase small mb-2">Available Rooms</h6>
                                        <h3 class="m-0 fw-bold">12</h3>
                                    </div>
                                    <div class="rounded-circle bg-white p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px">
                                        <i class="fas fa-door-open text-primary fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Monthly Guests Chart</h4>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-4">
                            <canvas 
                                this-year="{{ Helper::thisYear() }}" 
                                this-month="{{ Helper::thisMonth() }}"
                                id="visitors-chart" 
                                height="250" 
                                class="chartjs-render-monitor w-100">
                            </canvas>
                        </div>
                        <div class="d-flex justify-content-center gap-4 mt-3">
                            <div class="d-flex align-items-center">
                                <span class="bg-primary d-inline-block me-2" style="width: 14px; height: 14px;"></span>
                                <span>{{ Helper::thisMonth() }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="bg-secondary d-inline-block me-2" style="width: 14px; height: 14px;"></span>
                                <span>Previous Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards - Enhanced with modern look -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="card border-0 rounded-lg shadow-sm h-100 hover-shadow transition-300">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold text-muted mb-2">Current Guests</p>
                                <h3 class="m-0 fw-bold text-info">{{ count($transactions) }}</h3>
                            </div>
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px">
                                <i class="fas fa-users text-info fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('footer')
    <!-- Add custom CSS for enhanced styling -->
    <style>
        /* Custom background gradients */
        .bg-gradient-primary {
            background: linear-gradient(135deg,rgb(36, 58, 146),rgb(35, 31, 31));
        }
        
        /* Soft background colors for badges */
        .bg-success-soft {
            background-color: rgba(40, 167, 69, 0.15);
        }
        
        .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.15);
        }
        
        .bg-warning-soft {
            background-color: rgba(255, 193, 7, 0.15);
        }
        
        .bg-info-soft {
            background-color: rgba(23, 162, 184, 0.15);
        }
        
        .bg-primary-soft {
            background-color: rgba(78, 115, 223, 0.15);
        }
        
        /* Hover shadow effect */
        .hover-shadow {
            transition: all 0.3s ease;
        }
        
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .transition-300 {
            transition: all 0.3s ease;
        }
        
        /* Timeline styling */
        .timeline-item {
            margin-bottom: 1.5rem;
        }
        
        .timeline-badge {
            left: -20px;
            width: 40px;
            height: 40px;
            z-index: 1;
        }
        
        .timeline-item:last-child {
            border-left: none !important;
        }
    </style>
 
    <script>
        function reloadJs(src) {
            src = $('script[src$="' + src + '"]').attr("src");
            $('script[src$="' + src + '"]').remove();
            $('<script/>').attr('src', src).appendTo('head');
        }

        Echo.channel('dashboard')
            .listen('.dashboard.event', (e) => {
                $("#dashboard").fadeOut(150);
                $("#dashboard").load(window.location.href + " #dashboard", function() {
                    $("#dashboard").fadeIn(300);
                    // Reinitialize charts and any other JS components
                    reloadJs('style/js/chart.min.js');
                    const event = new Event('DOMContentLoaded');
                    document.dispatchEvent(event);
                });
                
                // Enhanced notification
                toastr.options = {
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000"
                };
                toastr.warning(e.message, "Hello, {{ auth()->user()->name }}");
            });
    </script>
@endsection
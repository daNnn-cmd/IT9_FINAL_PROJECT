<style>

    .nav-link i {
    font-size: 1.25rem;
    background: linear-gradient(135deg, #1a2a6c, #b21f1f);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text; /* for non-webkit browsers */
    color: transparent;
    display: inline-block;
}


    #sidebar-wrapper {
        background: linear-gradient(135deg,rgb(255, 255, 255),rgb(255, 255, 255));
        background-size: 400% 400%;
        animation: gradient 18s ease infinite;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .nav-flush {
        padding: 1rem 0;
    }
    
    .nav-link {
        color: rgba(9, 8, 9, 0.8);
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        margin: 0 0.5rem;
    }
    
    .nav-link:hover {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
    }
    
    .nav-link.active {
        color: white;
        background: rgba(255, 255, 255, 0.2);
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .nav-link i {
        font-size: 1.25rem;
    }
    
    .dropdown-menu {
    background: white;
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    padding: 0.5rem;
}

.dropdown-item {
    color: black;
    background: transparent;
    border-radius: 0.25rem;
    padding: 0.5rem 1rem;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: #f0f0f0; /* light gray on hover */
    color: black;
    transform: translateX(5px);
}

    
    .dropend:hover .dropdown-menu {
        display: block;
        margin-top: 0;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(10px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    #sidebar-wrapper .dropdown-menu.show {
        top: -60px !important;
        left: 80px !important;
    }
    
    /* Hotel Key Card Effect */
    .nav-item {
        position: relative;
    }
    
    .nav-item::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
        transition: all 0.3s ease;
    }
    
    .nav-item:hover::after {
        width: 80%;
        background: purple;
    }
    
    /* Tooltip styling */
    .tooltip-inner {
        background-color: rgba(26, 42, 108, 0.9);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }
    
    .bs-tooltip-end .tooltip-arrow::before {
        border-right-color: rgba(26, 42, 108, 0.9);
    }
</style>

<div class="position-fixed h-100" id="sidebar-wrapper">
    <div class="d-flex flex-column" style="width: 5rem;">
        <div class="text-center py-3">
            <i class="fas fa-hotel text-black" style="font-size: 1.75rem;"></i>
        </div>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">

            <li class="nav-item mb-3 rounded cursor-pointer">
                <a href="{{ route('dashboard.index') }}"
                   class="nav-link py-3 myBtn
                   {{ in_array(Route::currentRouteName(), ['dashboard.index', 'chart.dailyGuest']) ? 'active' : '' }}"
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="fas fa-home"></i>
                </a>
            </li>

            @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')

                <li class="nav-item mb-3 rounded cursor-pointer"> 
    <a class="nav-link py-3 myBtn dropdown-toggle 
       {{ in_array(Route::currentRouteName(), [
           'transaction.index', // Active Guests
           'transaction.p', // Past Reservations
           'transaction.past_reservation',
           'payment.index',
           'transaction.reservation.createIdentity',
           'transaction.reservation.pickFromCustomer',
           'transaction.reservation.usersearch',
           'transaction.reservation.storeCustomer',
           'transaction.reservation.viewCountPerson',
           'transaction.reservation.chooseRoom',
           'transaction.reservation.confirmation',
           'transaction.reservation.payDownPayment'
       ]) ? 'active' : '' }}"
       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"
       data-bs-placement="right" title="Reservations">
        <i class="fas fa-concierge-bell"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('transaction.index') }}">
                <i class="fas fa-door-closed me-2"></i> Active Guests Section
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('transaction.p') }}">
                <i class="fas fa-tags me-2"></i> Past Reservations Section
            </a>
        </li>
    </ul>
</li>


                <li class="nav-item mb-3 rounded cursor-pointer">
                    <a class="nav-link py-3 myBtn dropdown-toggle 
                       {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit']) ? 'active' : '' }}"
                       data-bs-toggle="dropdown" aria-expanded="false"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Rooms Management">
                        <i class="fas fa-door-open"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('room.index') }}"><i class="fas fa-door-closed me-2"></i>Rooms</a></li>
                        <li><a class="dropdown-item" href="{{ route('type.index') }}"><i class="fas fa-tags me-2"></i>Room Types</a></li>
                        <li><a class="dropdown-item" href="{{ route('roomstatus.index') }}"><i class="fas fa-info-circle me-2"></i>Status</a></li>
                    </ul>
                </li>

                <li class="nav-item mb-3 rounded cursor-pointer">
                    <a class="nav-link py-3 myBtn dropdown-toggle
                       {{ in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.edit', 'user.index', 'user.create', 'user.edit']) ? 'active' : '' }}"
                       data-bs-toggle="dropdown" aria-expanded="false"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Guests & Staff">
                        <i class="fas fa-users"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('customer.index') }}">
                                <i class="fas fa-user-tie me-2"></i>Customer
                            </a>
                        </li>
                        @if (auth()->user()->role == 'Super')
                            <li>
                                <a class="dropdown-item" href="{{ route('user.index') }}">
                                    <i class="fas fa-user-cog me-2"></i>User
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="nav-item mb-3 rounded cursor-pointer">
                    <a href="{{ route('services_h.index') }}" 
                       class="nav-link py-3 myBtn {{ request()->routeIs('services_h.*') ? 'active' : '' }}"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Hotel Services">
                        <i class="fas fa-utensils"></i>
                    </a>
                </li>

                <li class="nav-item mb-3 rounded cursor-pointer">
                    <a href="{{ route('loyalty_program.index') }}" 
                       class="nav-link py-3 myBtn {{ request()->routeIs('loyalty_program.*') ? 'active' : '' }}"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Loyalty Program">
                        <i class="fas fa-gift"></i>
                    </a>
                </li>

                <li class="nav-item mb-3 rounded cursor-pointer">
                    <a href="{{ route('discount_tracking.index') }}" 
                       class="nav-link py-3 myBtn {{ request()->routeIs('discount_tracking.*') ? 'active' : '' }}"
                       data-bs-toggle="tooltip" data-bs-placement="right" title="Discount Tracking">
                        <i class="fas fa-percent"></i>
                    </a>
                </li>

                <li class="nav-item mb-3 rounded cursor-pointer">
    <a href="{{ route('reports.revenue') }}" 
       class="nav-link py-3 myBtn {{ request()->routeIs('reports.revenue') ? 'active' : '' }}"
       data-bs-toggle="tooltip" data-bs-placement="right" title="Revenue Report">
        <i class="fas fa-chart-line"></i>
    </a>
</li>

            @endif

        </ul>
    </div>
</div>


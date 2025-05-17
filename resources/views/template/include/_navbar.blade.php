<nav class="navbar navbar-expand navbar-light px-3 shadow-sm fixed-top" style="height: 60px; background: linear-gradient(135deg, #1a2a6c, #b21f1f);">
    <div class="container-fluid">
        <!-- Menu Toggle Icon -->
        <div id="menu-toggle" class="p-2 border rounded d-flex justify-content-center align-items-center cursor-pointer"
            style="width: 2rem; height: 2rem; border-color:rgb(180, 183, 241) !important; color:rgb(206, 201, 223); transition: all 0.3s ease;">
            <i class="fa fa-bars" style="font-size: 18px;"></i>
        </div>
        
        <!-- Navbar Toggler (for mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(70%) sepia(50%) saturate(500%) hue-rotate(200deg);"></span>
        </button>

        <!-- Navbar Menu Items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="dropdown ms-auto me-4" id="refreshThisDropdown">
                <div class="dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffbc00; font-weight: 600;">
                    <!-- Optional content for the dropdown button -->
                </div>
            </div>

            <!-- User Avatar Dropdown -->
            <div class="dropdown">
                <div class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->getAvatar() }}" class="rounded-circle img-thumbnail"
                        style="cursor: pointer; border-color:rgb(127, 0, 11) !important; transition: all 0.3s ease;" width="40" height="40" alt="User Avatar">
                </div>
                
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1" style="background-color: #1a2a6c; border: 1px solid #b21f1f; border-radius: 8px;">
                    <li><a class="dropdown-item" style="color: #e0e0ff; font-weight: 500;" href="{{ route('user.show', ['user' => auth()->user()->id]) }}">Profile</a></li>
                    <li><a class="dropdown-item" style="color: #e0e0ff; font-weight: 500;" href="{{route('activity-log.index')}}">Activity</a></li>
                    <li><hr class="dropdown-divider" style="border-color:rgb(126, 25, 220);"></li>
                    <form action="/logout" method="POST">
                        @csrf
                        <li><button class="dropdown-item" type="submit" style="color: #ff7a7a; font-weight: 500;">Logout</button></li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>

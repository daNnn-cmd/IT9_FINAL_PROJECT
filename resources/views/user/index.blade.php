@extends('template.master')
@section('title', 'User Management')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    /* Base Styles & Variables */
    :root {
        --primary:rgb(92, 122, 246);
        --primary-dark: #1d4ed8;
        --secondary: #64748b;
        --success: #10b981;
        --danger: #ef4444;
        --light: #f8fafc;
        --dark: #1e293b;
        --border-radius: 12px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        --transition: all 0.2s ease-in-out;
    }
    
    .um-container {
        background-color: #f1f5f9;
        padding: 2rem 0;
        min-height: calc(100vh - 60px);
    }
    
    /* Header Section */
    .um-header {
        background-color: var(--primary);
        color: white;
        padding: 1.75rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }
    
    .um-header::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1));
        z-index: 1;
    }
    
    .um-header-title {
        font-weight: 700;
        display: flex;
        align-items: center;
        margin: 0;
    }
    
    .um-header-title i {
        margin-right: 1rem;
        font-size: 1.5rem;
        background: rgba(255,255,255,0.2);
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    
    .um-badge {
        background: rgba(255,255,255,0.2);
        color: white;
        border-radius: 50px;
        padding: 0.35rem 1rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }
    
    /* Search Section */
    .um-search-action-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem; /* space between search form and add button */
  margin-bottom: 1.5rem;
}

.um-search-form {
  flex: 1;
  display: flex;
  align-items: center;
}

.um-search-input {
  flex: 1;
}
    
    .um-search-wrap:focus-within {
        box-shadow: var(--shadow-md);
    }
    
    .um-search-form {
        display: flex;
        align-items: center;
    }
    
    .um-search-input {
        flex: 1;
        border: none;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        outline: none;
    }
    
    .um-search-input::placeholder {
        color: var(--secondary);
    }
    
    .um-search-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 500;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .um-search-btn:hover {
        background: var(--primary-dark);
    }
    
    .um-add-btn {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        padding: 0.85rem 1.5rem;
        font-weight: 600;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-sm);
        text-decoration: none;
    }
    
    .um-add-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
    }
    
    /* Users Grid Layout */
    .um-users-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .um-user-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
    }
    
    .um-user-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .um-user-info {
        padding: 1.5rem;
        flex: 1;
    }
    
    .um-user-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    
    .um-user-email {
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    
    .um-user-role {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        background-color: rgba(37, 99, 235, 0.1);
        color: var(--primary);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }
    
    .um-user-actions {
        display: flex;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        background-color: #f8fafc;
        border-top: 1px solid rgba(0,0,0,0.05);
    }
    
    .um-action-btn {
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: white;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .um-action-btn:hover {
        transform: translateY(-2px);
        color: white;
    }
    
    .um-edit-btn {
        background-color: var(--success);
    }
    
    .um-edit-btn:hover {
        background-color: #0d9668;
    }
    
    .um-view-btn {
        background-color: var(--secondary);
    }
    
    .um-view-btn:hover {
        background-color: #475569;
    }
    
    .um-delete-btn {
        background-color: var(--danger);
    }
    
    .um-delete-btn:hover {
        background-color: #dc2626;
    }
    
    /* Empty State */
    .um-empty-state {
        background: white;
        padding: 4rem 2rem;
        text-align: center;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        grid-column: 1 / -1;
    }
    
    .um-empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f1f5f9;
        border-radius: 50%;
        font-size: 2.5rem;
        color: var(--secondary);
    }
    
    .um-empty-title {
        font-size: 1.5rem;
        color: var(--dark);
        margin-bottom: 1rem;
    }
    
    .um-empty-text {
        color: var(--secondary);
        margin-bottom: 1.5rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Pagination */
    .um-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    }
    
    .um-pagination .page-item {
        margin: 0 0.25rem;
    }
    
    .um-pagination .page-link {
        border-radius: 50px;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark);
        border: 1px solid #e2e8f0;
        background-color: white;
        transition: var(--transition);
        font-weight: 500;
    }
    
    .um-pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }
    
    .um-pagination .page-link:hover:not(.active) {
        background-color: #f1f5f9;
        border-color: #e2e8f0;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
    .um-search-action-row {
        flex-direction: column;
        gap: 1rem;
    }

    .um-search-wrap, .um-add-btn {
        width: 100%;
    }

    .um-add-btn {
        justify-content: center;
    }
}

</style>
@endsection

@section('content')
<div class="um-container">
    <div class="container">
        <!-- Header Section -->
        <div class="um-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="um-header-title"><i class="fas fa-users"></i>User Management</h1>
                <div class="um-badge">
                    <i class="fas fa-user-circle me-2"></i>{{ $users->total() }} Users
                </div>
            </div>
        </div>
        
        <!-- Search and Add User Section -->
        <div class="d-flex justify-content-between align-items-center um-search-action-row mb-4">
            <div class="um-search-wrap flex-grow-1 me-3">
                <form class="um-search-form" method="GET" action="{{ route('user.index') }}">
                    <input type="hidden" name="qc" value="{{ request()->input('qc') }}">
                    <input type="hidden" name="customers" value="{{ request()->input('customers') }}">
                    <input class="um-search-input" type="search" 
                           placeholder="Search users by name or email" aria-label="Search"
                           id="search-user" name="qu" value="{{ request()->input('qu') }}">
                    <button class="um-search-btn" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
            <a href="{{ route('user.create') }}" class="um-add-btn">
                <i class="fas fa-user-plus"></i> Add User
            </a>
        </div>
        
        <!-- User Grid Cards -->
<div class="um-users-grid">
    @forelse ($users as $user)
        <div class="um-user-card" id="user-card-{{ $user->id }}">
            <div class="um-user-info">
                <div class="um-user-name">{{ $user->name }}</div>
                <div class="um-user-email">
                    <i class="fas fa-envelope"></i> {{ $user->email }}
                </div>
                <div class="um-user-role">
                    <i class="fas fa-user-tag me-1"></i> {{ $user->role }}
                </div>
            </div>
            <div class="um-user-actions">
                <a href="{{ route('user.show', ['user' => $user->id]) }}" 
                   class="um-action-btn um-view-btn"
                   data-bs-toggle="tooltip" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>
                
                <a href="{{ route('user.edit', ['user' => $user->id]) }}" 
                   class="um-action-btn um-edit-btn"
                   data-bs-toggle="tooltip" title="Edit User">
                    <i class="fas fa-edit"></i>
                </a>
                
                
                
               
            </div>
        </div>
    @empty
        <div class="um-empty-state">
            <div class="um-empty-icon">
                <i class="fas fa-users-slash"></i>
            </div>
            <h3 class="um-empty-title">No Users Found</h3>
            <p class="um-empty-text">There are currently no users in the system matching your criteria.</p>
            <a href="{{ route('user.create') }}" class="um-add-btn">
                <i class="fas fa-user-plus"></i> Add Your First User
            </a>
        </div>
    @endforelse
</div>

        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="um-pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <!-- Previous Link -->
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    <!-- Pagination Numbers -->
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <!-- Next Link -->
                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                
                if (confirm(`Are you sure you want to delete user "${userName}"?`)) {
                    const form = document.getElementById(`delete-form-${userId}`);
                    if (form) {
                        form.submit();
                    }
                }
            });
        });
    });
</script>
@endsection

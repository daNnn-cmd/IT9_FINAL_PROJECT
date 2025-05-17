<style>
    @media screen and (max-width: 400px) {
        li.page-item {

            display: none;
        }

        .page-item:first-child,
        .page-item:nth-child(2),
        .page-item:nth-last-child(2),
        .page-item:last-child,
        .page-item.active,
        .page-item.disabled {

            display: block;
        }
    }

</style>
<!-- Create a new file: resources/views/template/paginationlinks.blade.php -->
@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link hotel-pagination-link" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link hotel-pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link hotel-pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link hotel-pagination-link hotel-pagination-active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link hotel-pagination-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link hotel-pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link hotel-pagination-link" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<!-- Add these styles to your existing stylesheet section in your main template -->
<style>
    .hotel-pagination-link {
        color: var(--dark-blue);
        border: 1px solid rgba(26, 42, 108, 0.2);
        margin: 0 3px;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 8px 14px;
    }
    
    .hotel-pagination-link:hover:not(.hotel-pagination-active):not(.disabled .page-link) {
        background-color: rgba(26, 42, 108, 0.1);
        border-color: rgba(26, 42, 108, 0.3);
        color: var(--dark-blue);
    }
    
    .hotel-pagination-active {
        background: linear-gradient(135deg, #1a2a6c, #b21f1f);
        color: white;
        border: none;
    }
    
    .pagination .page-item.disabled .hotel-pagination-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
    
    .pagination {
        margin-bottom: 0;
    }
</style>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/logo/1694675477283 (1).png') }}">

    <!-- Stylesheets -->
    @vite('resources/sass/app.scss')

    <title>@yield('title')</title>

    <!-- Additional head content (e.g., CSS, metadata) -->
    @yield('head')

    <!-- Optional scripts for specific pages -->
    @yield('scripts')
</head>

<body>
    <!-- Header Section -->
    <header>
        @include('template.include._navbar')
    </header>

    <!-- Main Content Section -->
    <main class="my-3">
        <!-- Modal -->
        <div class="modal fade" id="main-modal" tabindex="-1" aria-labelledby="main-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal Content Goes Here -->
                    </div>
                    <div class="modal-footer">
                        <button id="btn-modal-close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="btn-modal-save" type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Wrapper -->
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            @include('template.include._sidebar')

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    @vite('resources/js/app.js')
    @yield('footer')

    <!-- SweetAlert2 for Delete Confirmation -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Delete button functionality
            $(document).on('click', '.delete-btn', function() {
                const form = $(this).closest('form');
                const userName = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You're about to delete " + userName + ". This cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>

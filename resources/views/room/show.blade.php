@extends('template.master')
@section('title', 'Room')
@section('content')
    <div class="row">
        <!-- Customer Card -->
        <div class="col-md-3">
            @if (!empty($customer))
                <div class="card shadow-sm border rounded-lg">
                    <img class="myImages img-fluid rounded-top" src="{{ $customer->user->getAvatar() }}" style="object-fit: cover; height:250px;">
                    <div class="card-body">
                        <h5 class="mt-0 fw-bold text-primary">{{ $customer->name }}</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td><i class="fas fa-envelope text-muted"></i></td>
                                <td>{{ $customer->user->email }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-user-md text-muted"></i></td>
                                <td>{{ $customer->job }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt text-muted"></i></td>
                                <td class="text-nowrap">{{ $customer->address }}</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-phone text-muted"></i></td>
                                <td>+6281233808395</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-birthday-cake text-muted"></i></td>
                                <td>{{ $customer->birthdate }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="text-muted">Currently Empty</h4>
                    </div>
                </div>
            @endif
        </div>

        <!-- Room Details -->
        <div class="col-md-5 mb-3">
            <div class="card shadow-sm border rounded-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="fw-bold text-secondary">{{ $room->number }}</h3>
                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-upload"></i> Upload Image
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="fw-bold">Capacity: <span class="text-muted">{{ $room->capacity }}</span></p>
                        <p class="fw-bold">Price: <span class="text-muted">₱{{ number_format($room->price, 2) }}</span></p>
                        <p class="fw-bold">View: <span class="text-muted">{{ $room->view ?? 'N/A' }}</span></p>
                        
                        <!-- Room Type -->
                        <p class="fw-bold">Type: 
                            <span class="badge bg-primary">
                                {{ $room->type->name ?? 'N/A' }}
                            </span>
                        </p>
                        
                        <!-- Room Status -->
                        <p class="fw-bold">Status: 
                            <span class="badge bg-{{ $room->roomStatus->color ?? 'secondary' }}">
                                {{ $room->roomStatus->name ?? 'N/A' }}
                            </span>
                        </p>
                        
                        <!-- Room Service -->
                        <p class="fw-bold">Service: 
                            @if($room->service)
                                <span class="badge bg-info">
                                    {{ $room->service->name }} (₱{{ number_format($room->service->price, 2) }})
                                </span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                        
                        <!-- Service Description -->
                        @if($room->service && $room->service->description)
                            <div class="mt-2">
                                <h6 class="fw-bold">Service Description:</h6>
                                <p class="text-muted">{{ $room->service->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Images -->
        <div class="col-md-4">
            <div class="row g-3">
                @forelse ($room->image as $image)
                    <div class="col-md-6">
                        <div class="card shadow-sm border rounded-lg">
                            <img src="{{ $image->getRoomImage() }}" class="img-fluid rounded-top" style="object-fit: cover; height:250px;">
                            <div class="card-body text-center">
                                <form action="{{ route('image.destroy', ['image' => $image->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="text-muted">There are no images for this room</h4>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Upload Image Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('image.store', ['room' => $room->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="file" class="form-control form-control-lg" name="image">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @error('image')
        <script>
            toastr.error("{{ $message }}", "Failed");
        </script>
    @enderror
@endsection
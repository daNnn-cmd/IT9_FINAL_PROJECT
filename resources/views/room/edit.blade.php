<form id="form-save-room" class="row g-3 p-4 bg-white rounded shadow-lg border" method="POST" action="{{ route('room.update', ['room' => $room->id]) }}">
    @method('PUT')
    @csrf
    <h4 class="text-center fw-bold text-primary">Update Room Details</h4>
    
    <div class="col-md-12">
        <label for="type_id" class="form-label fw-semibold">Type</label>
        <select id="type_id" name="type_id" class="form-select select2">
            <option selected disabled>Choose room type</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" @if ($room->type->id == $type->id) selected @endif>{{ $type->name }}</option>
            @endforeach
        </select>
        <div id="error_type_id" class="text-danger error"></div>
    </div>
    
    <div class="col-md-12">
        <label for="room_status_id" class="form-label fw-semibold">Status</label>
        <select id="room_status_id" name="room_status_id" class="form-select select2">
            <option selected disabled>Choose room status</option>
            @foreach ($roomstatuses as $roomstatus)
                <option value="{{ $roomstatus->id }}" @if ($room->roomstatus->id == $roomstatus->id) selected @endif>{{ $roomstatus->name }} ({{ $roomstatus->code }})</option>
            @endforeach
        </select>
        <div id="error_room_status_id" class="text-danger error"></div>
    </div>
    
    <div class="col-md-12">
        <label for="service_id" class="form-label fw-semibold">Services</label>
        <select id="service_id" name="service_id" class="form-select select2">
            <option selected disabled>Choose room services</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" @if ($room->service_id == $service->id) selected @endif>
                    {{ $service->name }} - ${{ number_format($service->price, 2) }}
                </option>
            @endforeach
        </select>
        <div id="error_service_id" class="text-danger error"></div>
    </div>
    
    <div class="col-md-12">
        <label for="number" class="form-label fw-semibold">Room Number</label>
        <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ $room->number }}" placeholder="ex: 1A">
        <div id="error_number" class="text-danger error"></div>
    </div>
    
    <div class="col-md-6">
        <label for="capacity" class="form-label fw-semibold">Capacity</label>
        <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ $room->capacity }}" placeholder="ex: 4">
        <div id="error_capacity" class="text-danger error"></div>
    </div>
    
    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold">Price</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $room->price }}" placeholder="ex: 500000">
        <div id="error_price" class="text-danger error"></div>
    </div>
    
    <div class="col-md-12">
        <label for="view" class="form-label fw-semibold">View</label>
        <textarea class="form-control" id="view" name="view" rows="3" placeholder="ex: window see beach">{{ $room->view }}</textarea>
        <div id="error_view" class="text-danger error"></div>
    </div>
</form>
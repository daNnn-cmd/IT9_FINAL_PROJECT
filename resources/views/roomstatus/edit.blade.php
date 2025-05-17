<form id="form-save-roomstatus" class="row g-3 p-4 bg-white rounded shadow-lg border" method="POST" action="{{ route('roomstatus.update', ['roomstatus' => $roomstatus->id]) }}">
    @method('PUT')
    @csrf
    <h4 class="text-center fw-bold text-primary">Update Room Status</h4>

    <div class="col-md-12">
        <label for="name" class="form-label fw-semibold">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ $roomstatus->name }}" placeholder="e.g., Available, Occupied">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>

    <div class="col-md-12">
        <label for="code" class="form-label fw-semibold">Code</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
            name="code" value="{{ $roomstatus->code }}" placeholder="e.g., AV, OC">
        @error('code')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <div id="error_code" class="text-danger error"></div>
    </div>

    <div class="col-md-12">
        <label for="information" class="form-label fw-semibold">Information</label>
        <textarea class="form-control @error('information') is-invalid @enderror" id="information" name="information" rows="3" placeholder="Additional details (e.g., available for bookings, under maintenance)">{{ $roomstatus->information }}</textarea>
        @error('information')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <div id="error_information" class="text-danger error"></div>
    </div>
</form>

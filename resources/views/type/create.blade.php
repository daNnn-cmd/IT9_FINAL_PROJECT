<form id="form-save-type" class="row g-3 p-4 bg-light rounded shadow-sm" method="POST" action="{{ route('type.store') }}">
    @csrf
    <h4 class="text-center fw-bold text-primary">Add New Room Type</h4>

    <div class="col-md-12">
        <label for="name" class="form-label fw-semibold">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ old('name') }}" placeholder="ex: Deluxe, Suite, etc.">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <div id="error_name" class="text-danger error"></div>
    </div>

    <div class="col-md-12">
        <label for="information" class="form-label fw-semibold">Information</label>
        <textarea class="form-control" id="information" name="information" rows="3" placeholder="Additional description (e.g., includes Wi-Fi, king bed)">{{ old('information') }}</textarea>
        @error('information')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
        <div id="error_information" class="text-danger error"></div>
    </div>
</form>

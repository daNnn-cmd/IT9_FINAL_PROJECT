<form id="form-save-room" class="row g-3 p-4 bg-light rounded shadow-sm" method="POST" action="{{ route('room.store') }}" novalidate>
    @csrf
    <h4 class="text-center fw-bold text-primary mb-4">Add New Room</h4>
    
    <!-- Room Type -->
    <div class="col-md-12">
        <label for="type_id" class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
        <select id="type_id" name="type_id" class="form-select select2 @error('type_id') is-invalid @enderror" required>
            <option value="" selected disabled>Choose room type</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        @error('type_id')
            <div id="error_type_id" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>

    <!-- Room Status -->
    <div class="col-md-12">
        <label for="room_status_id" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
        <select id="room_status_id" name="room_status_id" class="form-select select2 @error('room_status_id') is-invalid @enderror" required>
            <option value="" selected disabled>Choose room status</option>
            @foreach ($roomstatuses as $roomstatus)
                <option value="{{ $roomstatus->id }}" {{ old('room_status_id') == $roomstatus->id ? 'selected' : '' }}>
                    {{ $roomstatus->name }} ({{ $roomstatus->code }})
                </option>
            @endforeach
        </select>
        @error('room_status_id')
            <div id="error_room_status_id" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Services (Optional) -->
    <div class="col-md-12">
        <label for="service_id" class="form-label fw-semibold">Services</label>
        <select id="service_id" name="service_id" class="form-select select2 @error('service_id') is-invalid @enderror">
            <option value="" selected disabled>Choose room services (optional)</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }} - ${{ number_format($service->price, 2) }}
                </option>
            @endforeach
        </select>
        @error('service_id')
            <div id="error_service_id" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Room Number -->
    <div class="col-md-12">
        <label for="number" class="form-label fw-semibold">Room Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('number') is-invalid @enderror" 
               id="number" name="number" value="{{ old('number') }}" 
               placeholder="ex: 1A" required>
        @error('number')
            <div id="error_number" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Capacity -->
    <div class="col-md-6">
        <label for="capacity" class="form-label fw-semibold">Capacity <span class="text-danger">*</span></label>
        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
               id="capacity" name="capacity" value="{{ old('capacity') }}" 
               placeholder="ex: 4" min="1" required>
        @error('capacity')
            <div id="error_capacity" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- Price -->
    <div class="col-md-6">
        <label for="price" class="form-label fw-semibold">Price <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"></span>
            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                   id="price" name="price" value="{{ old('price') }}" 
                   placeholder="ex: 500000" min="0" step="0.01" required>
        </div>
        @error('price')
            <div id="error_price" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>
    
    <!-- View -->
    <div class="col-md-12">
        <label for="view" class="form-label fw-semibold">View</label>
        <textarea class="form-control @error('view') is-invalid @enderror" 
                  id="view" name="view" rows="3" 
                  placeholder="ex: window see beach">{{ old('view') }}</textarea>
        @error('view')
            <div id="error_view" class="text-danger error">{{ $message }}</div>
        @enderror
    </div>

</form>

@push('scripts')
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });
        
        // Form validation
        $('#form-save-room').on('submit', function(e) {
            let isValid = true;
            
            // Validate required fields
            $('[required]').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill all required fields');
            }
        });
    });
</script>
@endpush
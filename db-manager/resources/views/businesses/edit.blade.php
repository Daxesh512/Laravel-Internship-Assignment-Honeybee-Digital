<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Business: ') }} {{ $business->business_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                <div class="mb-4">
                    @if($business->is_duplicate)
                        <div class="alert alert-warning py-2 small">This record is flagged as a <strong>Duplicate</strong>.</div>
                    @endif
                    @if($business->is_incomplete)
                        <div class="alert alert-danger py-2 small">This record is flagged as <strong>Incomplete</strong>.</div>
                    @endif
                </div>

                <form action="{{ route('businesses.update', $business->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Business Name</label>
                            <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name', $business->business_name) }}" required>
                            @error('business_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $business->category) }}" required>
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ old('address', $business->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input type="text" name="area" class="form-control" value="{{ old('area', $business->area) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $business->city) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Ratings</label>
                            <input type="number" step="0.1" name="ratings" class="form-control" value="{{ old('ratings', $business->ratings) }}">
                        </div>
                    </div>

                    <div class="row border-bottom pb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone 1</label>
                            <input type="text" name="phone1" class="form-control" value="{{ old('phone1', $business->phone1) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone 2</label>
                            <input type="text" name="phone2" class="form-control" value="{{ old('phone2', $business->phone2) }}">
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary px-5">Update Business</button>
                            <a href="{{ route('businesses.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>

                <div class="mt-5 pt-4 border-top">
                    <h6 class="text-danger fw-bold">Danger Zone</h6>
                    <p class="text-muted small">Once deleted, the record will be moved to trash (Soft Delete).</p>
                    <form action="{{ route('businesses.destroy', $business->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this business?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete Business Record</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
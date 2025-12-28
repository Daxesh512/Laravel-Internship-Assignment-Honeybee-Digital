<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Bulk Import Businesses') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Excel/CSV File</label>
                        <input type="file" name="file" class="form-control" required>
                        <div class="form-text mt-2">Required Headers: Name, Category, Address, Area, City, phone1</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Upload and Process</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
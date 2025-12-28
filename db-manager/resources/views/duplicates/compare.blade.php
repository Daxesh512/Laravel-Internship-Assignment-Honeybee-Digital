<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Resolve Duplicates') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('duplicates.merge') }}" method="POST">
                @csrf
                <input type="hidden" name="master_id" value="{{ $master->id }}">
                
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Field</th>
                                <th class="w-25">Master Record (Edit below)</th>
                                @foreach($duplicates as $dup)
                                    <th>Duplicate (ID: {{ $dup->id }})</th>
                                    <input type="hidden" name="duplicate_ids[]" value="{{ $dup->id }}">
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php $fields = ['business_name', 'category', 'address', 'area', 'city', 'phone1', 'phone2']; @endphp
                            @foreach($fields as $field)
                            <tr>
                                <td class="fw-bold text-capitalize">{{ str_replace('_', ' ', $field) }}</td>
                                <td>
                                    <input type="text" name="{{ $field }}" id="master_{{ $field }}" value="{{ $master->$field }}" class="form-control">
                                </td>
                                @foreach($duplicates as $dup)
                                <td class="bg-light">
                                    {{ $dup->$field ?? 'N/A' }}
                                    <button type="button" class="btn btn-sm btn-link float-end" onclick="document.getElementById('master_{{ $field }}').value='{{ $dup->$field }}'">Copy</button>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="alert alert-warning mt-4 d-flex justify-content-between align-items-center">
                        <span>Merging will update the <strong>Master Record</strong> and <strong>Delete</strong> all duplicates.</span>
                        <button type="submit" class="btn btn-danger">Confirm Merge & Delete Duplicates</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
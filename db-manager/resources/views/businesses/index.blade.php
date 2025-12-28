<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Business Directory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="d-flex justify-content-between mb-4">
                    <form action="{{ route('businesses.index') }}" method="GET" class="d-flex w-50">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search by name, city, or area...">
                        <button type="submit" class="btn btn-dark">Search</button>
                    </form>
                    <a href="{{ route('businesses.create') }}" class="btn btn-primary">+ Add Business</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($businesses as $b)
                            <tr>
                                <td class="fw-bold">{{ $b->business_name }}</td>
                                <td>{{ $b->category }}</td>
                                <td>{{ $b->city }}, {{ $b->area }}</td>
                                <td>
                                    @if($b->is_duplicate) <span class="badge bg-warning text-dark">Duplicate</span> @endif
                                    @if($b->is_incomplete) <span class="badge bg-danger">Incomplete</span> @endif
                                    @if(!$b->is_duplicate && !$b->is_incomplete) <span class="badge bg-success">Verified</span> @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('businesses.edit', $b->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('businesses.destroy', $b->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this record?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $businesses->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
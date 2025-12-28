<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Duplicate Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="mb-4">
                    <h4 class="fw-bold">Pending Resolutions</h4>
                    <p class="text-muted">The following records have been identified as potential duplicates based on Name, Address, and City.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light">
                            <tr>
                                <th>Master Business Name</th>
                                <th>Location</th>
                                <th>Duplicate Count</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($masters as $master)
                            <tr>
                                <td>
                                    <div class="fw-bold text-primary">{{ $master->business_name }}</div>
                                    <small class="text-muted">ID: #{{ $master->id }}</small>
                                </td>
                                <td>{{ $master->area }}, {{ $master->city }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-danger">
                                        {{ $master->duplicates_count ?? $master->duplicates->count() }} detected
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('duplicates.compare', $master->id) }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                                        Compare & Resolve
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <div class="mb-2"><i class="bi bi-check-circle fs-1"></i></div>
                                    No duplicate records found in the database.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $masters->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
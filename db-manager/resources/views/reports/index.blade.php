<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analytical Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-0 text-gray-800">Database Health & Metrics</h4>
                </div>
                <a href="{{ route('reports.export') }}" class="btn btn-success d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download Excel Report
                </a>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="bg-white p-4 shadow-sm rounded-lg h-100">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Business Density by City</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="text-muted small uppercase">
                                    <tr>
                                        <th>City Name</th>
                                        <th class="text-end">Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cityWise as $city)
                                    <tr>
                                        <td>{{ $city->city }}</td>
                                        <td class="text-end fw-bold">{{ number_format($city->count) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="bg-white p-4 shadow-sm rounded-lg h-100">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Category Breakdown (by City)</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="text-muted small uppercase">
                                    <tr>
                                        <th>Category</th>
                                        <th>City</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categoryCity as $item)
                                    <tr>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td class="text-end fw-bold">{{ number_format($item->count) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-dark text-white p-4 shadow-sm rounded-lg mt-2">
                <div class="row text-center">
                    <div class="col-md-4 border-end border-secondary">
                        <small class="text-secondary uppercase">Unique Listings</small>
                        <h3 class="fw-bold">{{ $stats['unique'] }}</h3>
                    </div>
                    <div class="col-md-4 border-end border-secondary">
                        <small class="text-secondary uppercase">Duplicate Records</small>
                        <h3 class="fw-bold text-warning">{{ $stats['duplicates'] }}</h3>
                    </div>
                    <div class="col-md-4">
                        <small class="text-secondary uppercase">Incomplete Records</small>
                        <h3 class="fw-bold text-danger">{{ $stats['incomplete'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
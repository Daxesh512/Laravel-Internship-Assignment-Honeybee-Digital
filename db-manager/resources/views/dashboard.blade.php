<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Directory Insights') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-primary text-white text-center p-3">
                        <p class="mb-0">Total Businesses</p>
                        <h2 class="fw-bold">{{ $stats['total'] }}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-success text-white text-center p-3">
                        <p class="mb-0">Unique Records</p>
                        <h2 class="fw-bold">{{ $stats['unique'] }}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-warning text-dark text-center p-3">
                        <p class="mb-0">Duplicates</p>
                        <h2 class="fw-bold">{{ $stats['duplicates'] }}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 bg-danger text-white text-center p-3">
                        <p class="mb-0">Incomplete</p>
                        <h2 class="fw-bold">{{ $stats['incomplete'] }}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="bg-white p-4 shadow-sm rounded">
                        <h5 class="fw-bold mb-3">Top Cities</h5>
                        <ul class="list-group list-group-flush">
                            @foreach($cityWise as $city)
                            <li class="list-group-item d-flex justify-content-between">
                                {{ $city->city }} <span>{{ $city->count }} records</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 text-center d-flex align-items-center justify-content-center">
                    <a href="{{ route('reports.export') }}" class="btn btn-dark btn-lg px-5 shadow">Download Comprehensive Report (.xlsx)</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
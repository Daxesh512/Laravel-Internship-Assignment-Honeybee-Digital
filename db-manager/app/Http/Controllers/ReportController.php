<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller 
{
    /**
     * Display the reporting dashboard.
     */
    public function index() 
    {
        $stats = [
            'total' => Business::count(),
            'unique' => Business::where('is_duplicate', false)->count(),
            'duplicates' => Business::where('is_duplicate', true)->count(),
            'incomplete' => Business::where('is_incomplete', true)->count(),
        ];

        // SQL Optimized: City-wise Business Count
        $cityWise = Business::select('city', DB::raw('count(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->get();

        // SQL Optimized: Category + City-wise Count
        $categoryCity = Business::select('category', 'city', DB::raw('count(*) as count'))
            ->groupBy('category', 'city')
            ->orderBy('category', 'asc')
            ->get();

        return view('reports.index', compact('stats', 'cityWise', 'categoryCity'));
    }

    /**
     * Export the database to Excel.
     * This fixes the "Call to undefined method" error.
     */
    public function export()
    {
        return Excel::download(new ReportExport, 'business_report_' . now()->format('Y-m-d') . '.xlsx');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Imports\BusinessImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $query = Business::query();

        // Search & Filter Support
        if ($request->has('search')) {
            $query->where('business_name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $businesses = $query->latest()->paginate(15);
        return view('businesses.index', compact('businesses'));
    }

    public function importProcess(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);

        $import = new BusinessImport;
        Excel::import($import, $request->file('file'));
        
        $stats = $import->getStats();

        return redirect()->route('businesses.index')->with('success', 
            "Import Complete! Total: {$stats['total']}, Duplicates: {$stats['duplicates']}, Incomplete: {$stats['incomplete']}");
    }
    
    // Standard CRUD (store, update, destroy) follow standard Laravel patterns...
    public function create()
    {
        return view('businesses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'address'       => 'required|string',
            'area'          => 'required|string',
            'city'          => 'required|string',
            'phone1'        => 'required|string',
            'ratings'       => 'nullable|numeric|min:0|max:5',
        ]);

        Business::create($validated);

        return redirect()->route('businesses.index')->with('success', 'Business created successfully.');
    }

    public function edit(Business $business)
    {
        return view('businesses.edit', compact('business'));
    }

    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'category'      => 'required|string',
            'address'       => 'required|string',
            'area'          => 'required|string',
            'city'          => 'required|string',
            'phone1'        => 'required|string',
            'ratings'       => 'nullable|numeric|min:0|max:5',
        ]);

        $business->update($validated);

        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        $business->delete(); // Soft delete as per requirements
        return redirect()->route('businesses.index')->with('success', 'Business moved to trash.');
    }
    
    public function importForm()
    {
        return view('businesses.import');
    }

//     public function importForm()
// {
//     return view('businesses.import');
// }

// public function importProcess(Request $request)
// {
//     $request->validate(['file' => 'required|mimes:xlsx,csv']);
    
//     $import = new \App\Imports\BusinessImport;
//     \Maatwebsite\Excel\Facades\Excel::import($import, $request->file('file'));
    
//     $stats = $import->getStats();
    
//     return redirect()->route('businesses.index')->with('success', "Imported: {$stats['total']} records. Duplicates: {$stats['duplicates']}.");
// }
}
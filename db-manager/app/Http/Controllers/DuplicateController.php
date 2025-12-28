<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessService;
use Illuminate\Http\Request;

class DuplicateController extends Controller
{
    public function index()
    {
        // Get master records that actually have duplicates
        $masters = Business::whereHas('duplicates')
            ->with('duplicates')
            ->paginate(10);

        return view('duplicates.index', compact('masters'));
    }

    public function compare($masterId)
    {
        $master = Business::findOrFail($masterId);
        $duplicates = Business::where('master_record_id', $masterId)->get();

        return view('duplicates.compare', compact('master', 'duplicates'));
    }

    public function merge(Request $request, BusinessService $service)
    {
        $validated = $request->validate([
            'master_id' => 'required|exists:businesses,id',
            'duplicate_ids' => 'required|array',
            'business_name' => 'required',
            'category' => 'required',
            'address' => 'required',
            'area' => 'required',
            'city' => 'required',
            'phone1' => 'required',
        ]);

        $duplicateIds = $request->duplicate_ids;
        $masterId = $request->master_id;
        
        // Data to keep in the master record
        $preferredData = $request->only([
            'business_name', 'category', 'sub_category', 
            'ratings', 'address', 'area', 'city', 'phone1', 'phone2'
        ]);

        $service->mergeRecords($masterId, $duplicateIds, $preferredData);

        return redirect()->route('duplicates.index')
            ->with('success', 'Records merged successfully and duplicates removed.');
    }
}

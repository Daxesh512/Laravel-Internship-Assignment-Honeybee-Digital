<?php
namespace App\Services;

use App\Models\Business;
use Illuminate\Support\Facades\DB;

class BusinessService {
    public function processImportRow(array $row) {
        $name = trim($row['name'] ?? '');
        $address = trim($row['address'] ?? '');
        $area = trim($row['area'] ?? '');
        $city = trim($row['city'] ?? '');

        $isIncomplete = empty($name) || empty($address) || empty($area) || empty($city);

        // Check for duplicate: Name + Area + City + Address
        $master = Business::where([
            ['business_name', 'LIKE', $name],
            ['area', 'LIKE', $area],
            ['city', 'LIKE', $city],
            ['address', 'LIKE', $address],
            ['is_duplicate', '=', false]
        ])->first();

        return Business::create([
            'business_name' => $name ?: 'N/A',
            'category' => $row['category'] ?? 'General',
            'sub_category' => $row['subcategory'] ?? null,
            'ratings' => $row['ratings'] ?? null,
            'address' => $address ?: 'N/A',
            'area' => $area ?: 'N/A',
            'city' => $city ?: 'N/A',
            'phone1' => $row['phone1'] ?? 'N/A',
            'phone2' => $row['phone2'] ?? null,
            'is_incomplete' => $isIncomplete,
            'is_duplicate' => $master ? true : false,
            'master_record_id' => $master ? $master->id : null,
        ]);
    }

    public function mergeRecords($masterId, $duplicateIds, array $preferredData) {
        return DB::transaction(function () use ($masterId, $duplicateIds, $preferredData) {
            $master = Business::findOrFail($masterId);
            $master->update($preferredData);
            
            // Delete duplicates after merging
            Business::whereIn('id', $duplicateIds)->delete();
            return $master;
        });
    }
}
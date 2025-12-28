<?php

namespace App\Imports;

use App\Services\BusinessService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessImport implements ToModel, WithHeadingRow {
    private $stats = ['total' => 0, 'duplicates' => 0, 'incomplete' => 0];

    public function model(array $row) {
        $service = new BusinessService();
        $business = $service->processImportRow($row);

        $this->stats['total']++;
        if ($business->is_duplicate) $this->stats['duplicates']++;
        if ($business->is_incomplete) $this->stats['incomplete']++;

        return $business;
    }

    public function getStats() {
        return $this->stats;
    }
}
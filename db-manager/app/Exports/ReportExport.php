<?php

namespace App\Exports;

use App\Models\Business;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Business::select('business_name', 'category', 'city', 'area', 'phone1', 'is_duplicate', 'is_incomplete')->get();
    }

    public function headings(): array
    {
        return ['Business Name', 'Category', 'City', 'Area', 'Phone', 'Is Duplicate', 'Is Incomplete'];
    }
}

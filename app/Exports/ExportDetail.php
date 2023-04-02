<?php

namespace App\Exports;

use App\Models\Detail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDetail implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Detail::with(['transaction', 'product'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Transaction ID',
            'Product ID',
            'Quantity',
            'Total',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}

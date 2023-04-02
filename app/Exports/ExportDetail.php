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
        return Detail::with(['transaction', 'product'])
                ->select('transaction_detail.*', 'transactions.user_id', 'products.name', 'products.image', 'products.price', 'transactions.courier', 'transactions.transfer')
                ->join('transactions', 'transactions.id', '=', 'transaction_detail.transaction_id')
                ->join('products', 'products.id', '=', 'transaction_detail.product_id')
                ->get();
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

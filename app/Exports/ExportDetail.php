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
        return Detail::with(['transaction', 'product', 'transaction.user'])
                ->select('transaction_detail.*', 'transactions.user_id', 'users.name', 'users.address', 'users.email', 'users.phone', 'products.name', 'products.image', 'products.price', 'transactions.courier', 'transactions.transfer')
                ->join('transactions', 'transactions.id', '=', 'transaction_detail.transaction_id')
                ->join('products', 'products.id', '=', 'transaction_detail.product_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->orderBy('transactions.created_at', 'desc')
                ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Transaction ID',
            'Product ID',
            'Jumlah Produk',
            'Harga Produk',
            'status',
            'Created At',
            'Updated At',
            'User ID',
            'Nama Produk',
            'Alamat',
            'Email',
            'No. Telepon',
            'Gambar Produk',
            'Ongkir Kurir',
            'Kurir',
            'Bukti Transfer',
        ];
    }
}

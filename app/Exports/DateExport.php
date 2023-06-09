<?php
namespace App\Exports;

use App\Models\Detail;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class DateExport implements FromQuery
{
    use Exportable;

    protected $startDate;
    protected $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return Detail::with(['transaction', 'product', 'transaction.user'])
                ->select('transaction_detail.*', 'transactions.user_id', 'users.name', 'users.address', 'users.email', 'users.phone', 'products.name', 'products.image', 'products.price', 'transactions.courier', 'transactions.transfer')
                ->join('transactions', 'transactions.id', '=', 'transaction_detail.transaction_id')
                ->join('products', 'products.id', '=', 'transaction_detail.product_id')
                ->join('users', 'users.id', '=', 'transactions.user_id')
                ->whereBetween(DB::raw('DATE(transactions.created_at)'), [$this->startDate, $this->endDate])
                ->orderBy('transactions.created_at', 'desc');
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

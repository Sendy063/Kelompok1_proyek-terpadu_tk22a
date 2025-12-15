<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\ProdukTapioka;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Total Pendapatan (Status 'selesai')
        // Asumsi status 'selesai' berarti sudah dibayar dan dikirim
        $totalPendapatan = Order::where('status', 'selesai')->sum('total');

        // 2. Barang Terjual
        // Perlu looping karena items disimpan sebagai JSON
        $orders = Order::where('status', 'selesai')->get();
        $totalTerjual = 0;
        foreach ($orders as $order) {
            $items = is_string($order->items) ? json_decode($order->items, true) : $order->items;
            if (is_array($items)) {
                foreach ($items as $item) {
                     $totalTerjual += $item['quantity'] ?? 0;
                }
            }
        }

        // 3. Produk Tersedia (Jumlah jenis produk)
        // Karena tidak ada kolom stok, kita hitung jumlah variasi produk
        $totalProduk = ProdukTapioka::count();

        // Format Currency
        $formattedPendapatan = 'Rp ' . number_format($totalPendapatan, 0, ',', '.');

        return [
            Stat::make('Total Pendapatan', $formattedPendapatan)
                ->description('Total omzet penjualan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Dummy chart for visual

            Stat::make('Barang Terjual', $totalTerjual . ' pcs')
                ->description('Total unit produk terjual')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),

            Stat::make('Order Diproses', Order::where('status', 'diproses')->count())
                ->description('Pesanan sedang diproses')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('pending_payment', Order::where('status', 'pending_payment')->count())
                ->description('Pending Payment')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('danger'),

            Stat::make('Order Dikirim', Order::where('status', 'dikirim')->count())
                ->description('Pesanan sedang dalam pengiriman')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),

            Stat::make('Produk Tersedia', $totalProduk . ' Jenis')
                ->description('Total variasi produk di katalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
        ];
    }
}

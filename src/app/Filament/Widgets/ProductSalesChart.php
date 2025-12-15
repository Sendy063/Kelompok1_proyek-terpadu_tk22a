<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class ProductSalesChart extends ChartWidget
{
    protected static ?string $heading = 'Produk Terlaris';
    
    protected static ?int $sort = 2; // Position after stats overview

    protected function getData(): array
    {
        // Ambil semua order yang selesai
        $orders = Order::where('status', 'selesai')->get();
        
        $productSales = [];

        foreach ($orders as $order) {
            $items = is_string($order->items) ? json_decode($order->items, true) : $order->items;
            
            if (is_array($items)) {
                foreach ($items as $item) {
                    $namaProduk = $item['nama'] ?? 'Unknown Product';
                    $qty = $item['quantity'] ?? 0;

                    if (isset($productSales[$namaProduk])) {
                        $productSales[$namaProduk] += $qty;
                    } else {
                        $productSales[$namaProduk] = $qty;
                    }
                }
            }
        }

        // Sort dari yang terbanyak
        arsort($productSales);
        
        // Ambil top 5
        $topProducts = array_slice($productSales, 0, 5);
        
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual (Pcs)',
                    'data' => array_values($topProducts),
                    'backgroundColor' => '#ec4899', // Pink-500 equivalent usually looks nice
                    'borderColor' => '#db2777',
                ],
            ],
            'labels' => array_keys($topProducts),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

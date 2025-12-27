<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Pemesanan;
use Filament\Widgets\ChartWidget;

// TODO tambahkan chart penjualan per jenis katalog
class PemesananChart extends ChartWidget
{
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected ?string $heading = 'Grafik Pendapatan Bulanan';

    protected function getFilters(): ?array
    {
        return Pemesanan::whereHas('katalog.bisnis', function ($query) {
                $query->where('owner_id', auth('owner')->id());
            })
            ->selectRaw('YEAR(tanggal_pemesanan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year', 'year')
            ->toArray();
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $year = $activeFilter ? $activeFilter : date('Y');

        $data = Pemesanan::whereHas('katalog.bisnis', function ($query) {
                $query->where('owner_id', auth('owner')->id());
            })
            ->whereYear('tanggal_pemesanan', $year)
            ->whereNotIn('status', ['cancelled', 'unpaid'])
            ->selectRaw('MONTH(tanggal_pemesanan) as month, SUM(total_harga) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $datasets = [];
        $labels = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('M', mktime(0, 0, 0, $i, 1));
            $labels[] = $monthName;
            $datasets[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan',
                    'data' => $datasets,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Pemesanan;
use App\Models\Katalog;
use Filament\Widgets\ChartWidget;

class PenjualanChart extends ChartWidget
{
    protected static ?int $sort = 2;    

    protected ?string $heading = 'Penjualan Chart';

     protected function getFilters(): ?array
    {
        $types = Katalog::query()
            ->distinct()
            ->pluck('jenis', 'jenis')
            ->toArray();

        return array_merge(['all' => 'Semua'], $types);
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $year = date('Y');

        $query = Pemesanan::query()
            ->join('katalogs', 'pemesanan.katalog_id', '=', 'katalogs.katalog_id')
            ->whereYear('pemesanan.tanggal_pemesanan', $year)
            ->whereNotIn('pemesanan.status', ['cancelled', 'unpaid']);

        if ($activeFilter && $activeFilter !== 'all') {
            $query->where('katalogs.jenis', $activeFilter);
        }

        $results = $query
            ->selectRaw('MONTH(pemesanan.tanggal_pemesanan) as month, katalogs.jenis, COUNT(pemesanan.pemesanan_id) as total')
            ->groupBy('month', 'katalogs.jenis')
            ->get();

        $types = ($activeFilter && $activeFilter !== 'all') 
            ? [$activeFilter] 
            : Katalog::distinct()->pluck('jenis')->toArray();

        $datasets = [];
        $colors = [
            'Gamelan' => '#36A2EB',
            'Workshop' => '#FF6384',
            'Kelas' => '#4BC0C0',
        ];

        foreach ($types as $type) {
            $data = array_fill(1, 12, 0);
            
            foreach ($results as $row) {
                if ($row->jenis === $type) {
                    $data[$row->month] = $row->total;
                }
            }

            $color = $colors[$type] ?? '#' . substr(md5($type), 0, 6);

            $datasets[] = [
                'label' => ucfirst($type),
                'data' => array_values($data),
                'borderColor' => $color,
                'backgroundColor' => $color,
                'fill' => false,
            ];
        }

        $labels = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('M', mktime(0, 0, 0, $i, 1));
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

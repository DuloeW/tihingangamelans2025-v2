<?php

namespace App\Filament\Widgets;

use App\Models\Pemesanan;
use App\Models\Katalog;
use Filament\Widgets\ChartWidget;

class PendapatanChart extends ChartWidget
{
    protected static ?int $sort = 2;    
    
    // protected int | string | array $columnSpan = 'full';

    protected ?string $heading = 'Grafik Pendapatan Bulanan';

    protected function getFilters(): ?array
    {
        return Pemesanan::query()
            ->selectRaw('YEAR(tanggal_pemesanan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year', 'year')
            ->toArray();
    }

    protected function getData(): array
    {
        $year = $this->filter ?? date('Y');

        $results = Pemesanan::query()
            ->join('katalogs', 'pemesanan.katalog_id', '=', 'katalogs.katalog_id')
            ->whereYear('pemesanan.tanggal_pemesanan', $year)
            ->whereNotIn('pemesanan.status', ['cancelled', 'unpaid'])
            ->selectRaw('MONTH(pemesanan.tanggal_pemesanan) as month, katalogs.jenis, SUM(pemesanan.total_harga) as total')
            ->groupBy('month', 'katalogs.jenis')
            ->get();

        $types = Katalog::distinct()->pluck('jenis')->toArray();

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

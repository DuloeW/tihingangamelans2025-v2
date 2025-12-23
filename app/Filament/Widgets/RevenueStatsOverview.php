<?php

namespace App\Filament\Widgets;

use App\Models\Pemesanan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 1;
    }

    protected function getStats(): array
    {
        $total_pendapatan = Pemesanan::whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($total_pendapatan, 0, ',', '.'))
                ->description('Total pendapatan semua toko')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }
}

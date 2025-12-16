<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Katalog;
use App\Models\Pemesanan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    // protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {

        $total_pendapatan = Pemesanan::where('status', 'completed')
                                        ->orWhere('status', 'paid')->sum('total_harga');
        $total_pesanan = Pemesanan::whereNot('status', 'cancelled')->count();
        $total_katalog = Katalog::get()->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($total_pendapatan, 0, ',', '.'))
                ->description('Sejak Bergabung')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),
            Stat::make('Total Pemesanan', $total_pesanan)
                ->description('Sejak Bergabung')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('primary'),
            Stat::make('Katalog Tersedia', $total_katalog)
                ->description('Jumlah Katalog')
                ->color('warning'),
        ];
    }
}

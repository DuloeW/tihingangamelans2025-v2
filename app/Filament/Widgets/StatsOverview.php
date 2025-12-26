<?php

namespace App\Filament\Widgets;

use App\Models\Bisnis;
use App\Models\Pemesanan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{


    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $bisnis_active = Bisnis::whereIn('status', ['verified', 'active'])->count();
        $bisnis_unverified = Bisnis::where('status', ['unverified'])->count();
        $total_pemesanan = Pemesanan::whereNot('status', 'cancelled')->count();

        $pendapatan_gamelan = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Gamelan');
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');
        $pendapatan_kelas = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Kelas');
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');
        $pendapatan_workshop = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Workshop');
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');  

        return [
            Stat::make('Total Store Active', $bisnis_active)
                ->description('Bisnis Verified atau Active')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success'),
            
            Stat::make('Total Store Unverified', $bisnis_unverified)
                ->description('Bisnis Belum Verified')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('danger'),
            
            Stat::make('Total Pemesanan', $total_pemesanan)
                ->description('Pemesanan Semua Toko')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
            
            Stat::make('Pendapatan Gamelan', 'Rp ' . number_format($pendapatan_gamelan, 0, ',', '.'))
                ->description('Seluruh Store')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Pendapatan Workshop', 'Rp ' . number_format($pendapatan_workshop, 0, ',', '.'))
                ->description('Seluruh Store')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
                
            Stat::make('Pendapatan Kelas', 'Rp ' . number_format($pendapatan_kelas, 0, ',', '.'))
                ->description('Seluruh Store')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

        ];
    }
}

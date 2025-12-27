<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Katalog;
use App\Models\Pemesanan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    
    protected function getHeading(): ?string
    {
        return 'Laporan';
    }

    protected function getDescription(): ?string
    {
        return 'Berisi Laporan Singkat Pemesanan dan Pendapatan Bisnis Anda, Serta jumlah Katalog yang Tersedia.';
    }


    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {

        $total_pendapatan = Pemesanan::whereHas('katalog', function ($query) {
                                $query->whereHas('bisnis', function ($query) {
                                    $query->where('owner_id', auth('owner')->id());
                                });
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');
        $total_pesanan = Pemesanan::whereHas('katalog', function ($query) {
                                $query->whereHas('bisnis', function ($query) {
                                    $query->where('owner_id', auth('owner')->id());
                                });
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->count();
        $total_katalog = Katalog::whereHas('bisnis', function ($query) {
                                $query->where('owner_id', auth('owner')->id());
                            })->count();

        $pendapatan_gamelan = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Gamelan')
                                    ->whereHas('bisnis', function ($query) {
                                        $query->where('owner_id', auth('owner')->id());
                                    });
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');
        $pendapatan_workshop = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Workshop')
                                    ->whereHas('bisnis', function ($query) {
                                        $query->where('owner_id', auth('owner')->id());
                                    });
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');
        $pendapatan_kelas = Pemesanan::whereHas('katalog', function ($query) {
                                $query->where('jenis', 'Kelas')
                                    ->whereHas('bisnis', function ($query) {
                                        $query->where('owner_id', auth('owner')->id());
                                    });
                            })->whereNotIn('status', ['cancelled', 'unpaid'])->sum('total_harga');

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

            Stat::make('Pendapatan Gamelan', 'Rp ' . number_format($pendapatan_gamelan, 0, ',', '.'))
                ->description('Sejak Bergabung')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info'),
            
            Stat::make('Pendapatan Workshop', 'Rp ' . number_format($pendapatan_workshop, 0, ',', '.'))
                ->description('Sejak Bergabung')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info'),

            Stat::make('Pendapatan Kelas', 'Rp ' . number_format($pendapatan_kelas, 0, ',', '.'))
                ->description('Sejak Bergabung')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info'),
            
        ];
    }
}

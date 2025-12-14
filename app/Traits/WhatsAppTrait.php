<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait WhatsAppTrait
{
    /**
     * Fungsi utama untuk membuat link WhatsApp dengan pesan terformat
     * @param object $store Data toko (untuk ambil nama & no hp)
     * @param object $catalog Data produk
     * @param object $pesanan Data hasil create database
     * @param array $extraLines Baris tambahan (opsional, misal: Tanggal Workshop)
     */
    public function generateWaUrl($store, $catalog, $pesanan, $extraLines = [])
    {
        $nomorTujuan = $this->formatNomorHp($store->contactPerson()->first()->no_telephone);

        $pesan = "Halo *{$store->nama}*,\n\n";
        $pesan .= "Saya baru saja melakukan pemesanan via website.\n";
        $pesan .= "--------------------------------\n";
        $pesan .= "ID: *{$pesanan->pemesanan_id}*\n";
        $pesan .= "Produk: *{$catalog->nama}*\n";
        
        foreach ($extraLines as $label => $value) {
            $pesan .= "{$label} {$value}\n";
        }

        if($catalog->jenis == 'Gamelan' || $catalog->jenis == 'Workshop') {
            $pesan .= "Jumlah Anggota: {$pesanan->jumlah}\n";
        } else {
            $pesan .= "Jumlah: {$pesanan->jumlah}\n";
        }

        $totalRupiah = number_format($pesanan->total_harga, 0, ',', '.');
        $pesan .= "Total: Rp {$totalRupiah}\n";

        if(isset($pesanan->penerima)) {
            $pesan .= "Penerima: {$pesanan->penerima}\n";
        }

        $pesan .= "--------------------------------\n";
        $pesan .= "Mohon info pembayaran selanjutnya. Terima kasih.";

        $encodedPesan = rawurlencode($pesan);
        return "https://wa.me/{$nomorTujuan}?text={$encodedPesan}";
    }

    /**
     * Helper mengubah 08xx menjadi 62xx
     */
    private function formatNomorHp($nomor)
    {
        $nomor = preg_replace('/[^0-9]/', '', $nomor); // Hapus spasi/strip
        
        if (substr($nomor, 0, 1) === '0') {
            return '62' . substr($nomor, 1);
        }
        
        return $nomor;
    }
}
<?php

namespace App\Services;

use App\Models\Sales;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;

class DashboardService
{
    public function summaryBulanan(int $bulan, int $tahun): array
    {
        $queryBulanIni = TransaksiPenjualan::whereMonth('tanggal_transaksi', $bulan)
            ->whereYear('tanggal_transaksi', $tahun);

        return [
            'totalSales' => Sales::count(),
            'totalUnitBulanIni' => (clone $queryBulanIni)
                ->where('status_verifikasi', 'approved') 
                ->sum('jumlah_unit'),
            'totalPenjualan' => (clone $queryBulanIni)
                ->where('status_verifikasi', 'approved') 
                ->sum('harga_total'),
            'totalTransaksi' => (clone $queryBulanIni)
                ->where('status_verifikasi', 'approved') 
                ->count()        
            
        ];
    }

    public function getGrafikPenjualan(int $tahun): array
    {
        // 1. Ambil Data (Group by Bulan)
        $dataRaw = TransaksiPenjualan::whereYear('tanggal_transaksi', $tahun)
            ->where('status_verifikasi', 'approved')
            ->selectRaw('MONTH(tanggal_transaksi) as bulan')
            ->selectRaw('SUM(harga_total) as total_omset')
            ->selectRaw('SUM(jumlah_unit) as total_unit') // <--- Tambah ini
            ->groupBy('bulan')
            ->get()
            ->keyBy('bulan'); // Jadikan bulan sebagai Key array biar gampang dipanggil

        // 2. Siapkan Array Kosong 12 Bulan
        $revenue = [];
        $unit    = [];
        
        for ($i = 1; $i <= 12; $i++) {
            // Cek apakah bulan $i ada datanya?
            $item = $dataRaw->get($i);

            // Jika ada, ambil nilainya. Jika tidak, isi 0.
            $revenue[] = $item ? $item->total_omset : 0;
            $unit[]    = $item ? $item->total_unit : 0;
        }

        // 3. Kembalikan 2 Array
        return [
            'revenue' => $revenue,
            'unit'    => $unit
        ];
    } 
}

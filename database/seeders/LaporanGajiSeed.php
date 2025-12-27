<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sales;
use App\Models\TransaksiPenjualan;
use App\Models\LaporanGaji;
use Carbon\Carbon;

class LaporanGajiSeed extends Seeder
{
    public function run(): void
    {
        // Ambil semua sales
        $allSales = Sales::all();

        foreach ($allSales as $sales) {

            // Ambil transaksi sales ini
            $transaksi = TransaksiPenjualan::where('sales_id', $sales->id)->get();

            // Kelompokkan per bulan (YYYY-MM)
            $groupedByMonth = $transaksi->groupBy(function ($item) {
                return Carbon::parse($item->tanggal_transaksi)->format('Y-m');
            });

            foreach ($groupedByMonth as $periode => $items) {

                $komisiTotal = (int) $items->sum('komisi_penjualan');
                $gajiPokok   = (int) $sales->gaji_pokok;
                $totalGaji   = $gajiPokok + $komisiTotal;

                // Hindari duplicate (karena ada unique constraint)
                LaporanGaji::updateOrCreate(
                    [
                        'sales_id'      => $sales->id,
                        'periode_bulan' => $periode,
                    ],
                    [
                        'gaji_pokok_total'      => $gajiPokok,
                        'komisi_total'          => $komisiTotal,
                        'total_gaji_dibayarkan' => $totalGaji,
                    ]
                );
            }
        }
    }
}

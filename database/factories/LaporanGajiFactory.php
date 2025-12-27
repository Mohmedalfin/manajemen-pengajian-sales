<?php

namespace Database\Factories;

use App\Models\LaporanGaji;
use App\Models\Sales;
use App\Models\TransaksiPenjualan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class LaporanGajiFactory extends Factory
{
    protected $model = LaporanGaji::class;

    public function definition(): array
    {
        // 1️⃣ Ambil sales yang sudah ada
        $sales = Sales::inRandomOrder()->first();

        if (!$sales) {
            $sales = Sales::factory()->create();
        }

        // 2️⃣ Tentukan periode (YYYY-MM)
        $periode = now()->format('Y-m');

        // 3️⃣ Ambil transaksi sales di periode tsb
        $transaksi = TransaksiPenjualan::where('sales_id', $sales->id)
            ->whereYear('tanggal_transaksi', now()->year)
            ->whereMonth('tanggal_transaksi', now()->month)
            ->get();

        // 4️⃣ Hitung total komisi
        $komisiTotal = $transaksi->sum('komisi_penjualan');

        // 5️⃣ Hitung total gaji
        $gajiPokok = (int) $sales->gaji_pokok;
        $totalGaji = $gajiPokok + $komisiTotal;

        return [
            'sales_id'              => $sales->id,
            'periode_bulan'         => $periode,
            'gaji_pokok_total'      => $gajiPokok,
            'komisi_total'          => $komisiTotal,
            'total_gaji_dibayarkan' => $totalGaji,
        ];
    }
}

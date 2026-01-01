<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LaporanGajiService; 
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\LaporanGajiExport;


class LaporanGajiController extends Controller
{
    public function index(Request $request, LaporanGajiService $gajiService)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $query = $gajiService->getLaporanGaji($bulan, $tahun);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('sales.nama_lengkap', 'like', "%{$search}%");
            });
        }

        $gajiData = $query->get(); // atau ->paginate(10)

        $poinLaporan = $gajiService->getPoinLaporan($bulan, $tahun);

        return view('admin.laporan-gaji', [
            'gajiData' => $gajiData,
            'bulan'    => $bulan, 
            'tahun'    => $tahun,
            ...$poinLaporan
        ]);
    }

    public function exportExcel(Request $request)
    {
        // 1. Ambil Input
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);
        $search = $request->input('search');

        // 2. Nama File
        $namaFile = 'Laporan_Gaji_' . $bulan . '-' . $tahun . '.xlsx';

        // 3. DOWNLOAD (Ini yang membuat halaman tidak berpindah, tapi file terunduh)
        return Excel::download(new \App\Exports\LaporanGajiExport($bulan, $tahun, $search), $namaFile);
    }
}
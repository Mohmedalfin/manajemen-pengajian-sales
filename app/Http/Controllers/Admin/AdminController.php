<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Barang;
use App\Models\TransaksiPenjualan;
use App\Models\LaporanGajiController;
use App\Services\DashboardService;

class AdminController extends Controller
{
    public function index(Request $request, DashboardService $dashboard)
    {
        $query = TransaksiPenjualan::with(['sales', 'barang']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('kode_transaksi', 'like', "%{$search}%")
                  ->orWhereHas('sales', fn ($q) =>
                      $q->where('nama_lengkap', 'like', "%{$search}%")
                  )
                  ->orWhereHas('barang', fn ($q) =>
                      $q->where('nama_produk', 'like', "%{$search}%")
                  );
            });
        }

        $summary = $dashboard->summaryBulanan(now()->month, now()->year);

        $pertransaksi = $query
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.dashboard', [
            ...$summary,
            'pertransaksi' => $pertransaksi,
        ]);
    }
}


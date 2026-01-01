<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\TransaksiPenjualan;
use App\Services\DashboardService;

class AdminController extends Controller
{
    public function index(Request $request, DashboardService $dashboard)
    {
        $user = User::first();
        $queryTabel = TransaksiPenjualan::with('sales');

        $pertransaksi = $queryTabel->orderByDesc('created_at') // <--- PERBAIKAN DISINI
            ->paginate(10)
            ->withQueryString();

        $summary = $dashboard->summaryBulanan(now()->month, now()->year); 
        $grafik = $dashboard->getGrafikPenjualan(now()->year);

        $topSales = TransaksiPenjualan::with('sales')
            ->select('sales_id')
            ->selectRaw('SUM(harga_total) as total_omset')
            ->selectRaw('SUM(jumlah_unit) as total_unit')
            ->selectRaw('SUM(komisi_penjualan) as total_komisi')
            ->selectRaw('COUNT(*) as jumlah_transaksi')
            ->where('status_verifikasi', 'approved')
            ->whereMonth('tanggal_transaksi', now()->month) 
            ->whereYear('tanggal_transaksi', now()->year)
            ->groupBy('sales_id')
            ->orderByDesc('total_omset')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'user' => Auth::user(),
            'pertransaksi' => $pertransaksi,
            'topSales'     => $topSales,
            'grafikRevenue' => $grafik['revenue'],
            'grafikUnit'    => $grafik['unit'],
            ...$summary
        ]);
    }
}
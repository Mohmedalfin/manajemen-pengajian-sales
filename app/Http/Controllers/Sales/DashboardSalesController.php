<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\DashboardSalesService; 

class DashboardSalesController extends Controller
{
    protected $dashboardSalesService;

    public function __construct(DashboardSalesService $dashboardSalesService)
    {
        $this->dashboardSalesService = $dashboardSalesService;
    }

    public function index()
    {
        $bulan = date('m');
        $tahun = date('Y');

        // Pastikan ini sesuai relasi database Anda:
        // Opsi A: Jika User ID sama dengan Sales ID
        // $salesId = auth()->id(); 
        
        // Opsi B: Jika Tabel User beda dengan Tabel Sales (User punya relasi ke Sales)
        $salesId = auth()->user()->sales->id; 

        // Panggil Service
        $summary = $this->dashboardSalesService->summaryBulananPerSales($bulan, $tahun, $salesId);

        return view('sales.dashboard', compact('summary'));
    }
}
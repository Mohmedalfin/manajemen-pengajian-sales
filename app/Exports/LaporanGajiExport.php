<?php

namespace App\Exports;

use App\Services\LaporanGajiService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanGajiExport implements FromView, ShouldAutoSize, WithColumnFormatting
{
    protected $bulan;
    protected $tahun;
    protected $search;
    protected $gajiService;

    public function __construct($bulan, $tahun, $search)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->search = $search;
        // Inisialisasi Service secara manual atau via dependency injection controller
        $this->gajiService = new LaporanGajiService(); 
    }

    public function view(): View
    {
        // 1. Panggil Query Dasar dari Service (Sama persis seperti Controller)
        $query = $this->gajiService->getLaporanGaji($this->bulan, $this->tahun);

        // 2. Terapkan Filter Search (Sama persis seperti Controller)
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('sales.nama_lengkap', 'like', "%{$search}%");
            });
        }

        // 3. Eksekusi Query
        $data = $query->get();

        // 4. Return ke View khusus Excel
        return view('exports.laporan_gaji_excel', [
            'data'  => $data,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Gaji Pokok
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Total Omset
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Komisi
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Total Gaji
        ];
    }
}
{{-- resources/views/admin/laporan-gaji.blade.php --}}

@extends('layouts.admin')

@section('content')

<div class="space-y-6"> 

    {{-- 1. Filter Periode (FIXED: Dropdown tidak terpotong) --}}
    <form id="exportForm" action="{{ route('admin.laporan-gaji.export') }}" method="GET">
            
        <div class="relative bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 mb-10 text-white shadow-lg">
            
            {{-- Background Decoration --}}
            <div class="absolute inset-0 overflow-hidden rounded-2xl pointer-events-none">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white opacity-10 transform skew-x-12 translate-x-10"></div>
            </div>

            <div class="relative z-10">
                {{-- Header --}}
                <div class="flex items-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 mr-2"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"/></svg>
                    <h2 class="text-xl font-bold">Filter Periode</h2>
                </div>

                <div class="flex space-x-4 items-end">
                    
                    {{-- 1. DROPDOWN BULAN --}}
                    <div class="flex-1 min-w-[100px] relative dropdown-container" id="dropdownBulan">
                        <label class="text-sm font-semibold block mb-1">Bulan</label>
                        
                        {{-- Trigger Tombol --}}
                        <div class="dropdown-trigger w-full text-blue-600 bg-white border-none rounded-xl py-2 px-4 text-base shadow-inner flex justify-between items-center cursor-pointer"> 
                            {{-- Tampilkan Nama Bulan saat ini (Pakai int agar aman) --}}
                            <span class="dropdown-selected-label">
                                {{ \Carbon\Carbon::create()->month((int) request('bulan', now()->month))->translatedFormat('F') }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 dropdown-arrow transition duration-150"><path d="m6 9 6 6 6-6"/></svg>
                        </div>

                        {{-- List Opsi --}}
                        <ul class="dropdown-options absolute left-0 z-50 w-full mt-1 bg-white rounded-xl border border-gray-200 shadow-xl hidden max-h-40 overflow-y-auto">
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="1">Januari</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="2">Februari</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="3">Maret</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="4">April</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="5">Mei</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="6">Juni</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="7">Juli</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="8">Agustus</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="9">September</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="10">Oktober</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="11">November</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="12">Desember</li>
                        </ul>

                        {{-- Input Hidden (Ini yang dikirim ke Controller) --}}
                        <input type="hidden" name="bulan" class="dropdown-input" value="{{ request('bulan', now()->month) }}">
                    </div>
                    
                    {{-- 2. DROPDOWN TAHUN --}}
                    <div class="flex-1 min-w-[100px] relative dropdown-container" id="dropdownTahun">
                        <label class="text-sm font-semibold block mb-1">Tahun</label>
                        
                        <div class="dropdown-trigger w-full text-blue-600 bg-white border-none rounded-xl py-2 px-4 text-base shadow-inner flex justify-between items-center cursor-pointer">
                            <span class="dropdown-selected-label">{{ request('tahun', now()->year) }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 dropdown-arrow transition duration-150"><path d="m6 9 6 6 6-6"/></svg>
                        </div>

                        <ul class="dropdown-options absolute left-0 z-50 w-full mt-1 bg-white rounded-xl border border-gray-200 shadow-xl hidden max-h-40 overflow-y-auto">
                            {{-- PERBAIKAN: value harus sesuai dengan teks tahunnya --}}
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="2026">2026</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="2025">2025</li>
                            <li class="px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-800" data-value="2024">2024</li>
                        </ul>

                        <input type="hidden" name="tahun" class="dropdown-input" value="{{ request('tahun', now()->year) }}">
                    </div>

                    {{-- TOMBOL SUBMIT --}}
                    <button type="submit" class="flex-1 flex items-center justify-center space-x-2 bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition duration-150 hover:bg-green-700 shadow-md h-[42px]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m-3-3h6m-7 6h12a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Export Excel</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

    @php
        $valKomisi    = $totalKomisi ?? 0;
        $valTotalGaji = $totalGaji ?? 0;   
        $valRevenue   = $totalRevenue ?? 0;
        
        $valGajiPokok = $valTotalGaji - $valKomisi;

        $iconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>';
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10"> 
        
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <div class="flex justify-between items-start mb-4">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Gaji Pokok</p>
                <div class="p-1 rounded-lg bg-blue-100 text-blue-600">
                    {!! $iconSvg !!}
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-800">
                Rp {{ number_format($valGajiPokok, 0, ',', '.') }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <div class="flex justify-between items-start mb-4">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Komisi</p>
                <div class="p-1 rounded-lg bg-green-100 text-green-600">
                    {!! $iconSvg !!}
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-800">
                Rp {{ number_format($valKomisi, 0, ',', '.') }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <div class="flex justify-between items-start mb-4">
                <p class="text-gray-500 text-sm font-semibold uppercase">Total Pengeluaran</p>
                <div class="p-1 rounded-lg bg-orange-100 text-orange-600">
                    {!! $iconSvg !!}
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-800">
                Rp {{ number_format($valTotalGaji, 0, ',', '.') }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
            <div class="flex justify-between items-start mb-4">
                <p class="text-gray-500 text-sm font-semibold uppercase">Net Revenue</p>
                <div class="p-1 rounded-lg bg-purple-100 text-purple-600">
                    {!! $iconSvg !!}
                </div>
            </div>
            <div class="text-2xl font-bold text-gray-800">
                Rp {{ number_format($valRevenue, 0, ',', '.') }}
            </div>
        </div>

    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">Rekap Gaji Desember 2025</h2>
            <p class="text-sm text-green-600">Detail perhitungan gaji seluruh karyawan sales</p> 
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji Pokok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Terjual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Gaji</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($gajiData as $data)
                    <tr class="hover:bg-gray-50 transition">
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="font-semibold">{{ $data->nama_lengkap }}</div>
                            <div class="text-xs text-gray-500">ID: SLS-{{ str_pad($data->id, 3, '0', STR_PAD_LEFT) }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            Rp {{ number_format($data->gaji_pokok, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $data->total_transaksi }} kali
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $data->total_unit }} Unit
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium">
                            Rp {{ number_format($data->total_omset, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">
                            Rp {{ number_format($data->total_komisi, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-bold bg-blue-50">
                            Rp {{ number_format($data->gaji_pokok + $data->total_komisi, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data sales.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua elemen dengan class .dropdown-container
        const dropdowns = document.querySelectorAll('.dropdown-container');

        dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.dropdown-trigger');
            const optionsList = dropdown.querySelector('.dropdown-options');
            const selectedLabel = dropdown.querySelector('.dropdown-selected-label');
            const hiddenInput = dropdown.querySelector('.dropdown-input');
            const arrow = dropdown.querySelector('.dropdown-arrow');

            // 1. Toggle Buka/Tutup saat Trigger diklik
            trigger.addEventListener('click', (e) => {
                e.stopPropagation(); // Mencegah event bubbling
                
                // Tutup semua dropdown lain dulu biar rapi
                document.querySelectorAll('.dropdown-options').forEach(el => {
                    if (el !== optionsList) el.classList.add('hidden');
                });

                // Toggle class hidden
                optionsList.classList.toggle('hidden');
                
                // Efek putar panah (optional)
                if(arrow) arrow.classList.toggle('rotate-180');
            });

            // 2. Saat Opsi (li) dipilih
            dropdown.querySelectorAll('li').forEach(option => {
                option.addEventListener('click', () => {
                    // Ambil text (misal: "Januari") dan value (misal: "1")
                    const text = option.textContent;
                    const value = option.getAttribute('data-value');

                    // Update Tampilan Label
                    selectedLabel.textContent = text;

                    // Update Nilai Input Hidden (PENTING untuk dikirim ke Controller)
                    hiddenInput.value = value;

                    // Tutup dropdown setelah memilih
                    optionsList.classList.add('hidden');
                    if(arrow) arrow.classList.remove('rotate-180');
                });
            });
        });

        // 3. Tutup dropdown jika klik di luar area (sembarang tempat)
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-options').forEach(el => {
                    el.classList.add('hidden');
                });
                document.querySelectorAll('.dropdown-arrow').forEach(el => {
                    el.classList.remove('rotate-180');
                });
            }
        });
    });
</script>

@endsection
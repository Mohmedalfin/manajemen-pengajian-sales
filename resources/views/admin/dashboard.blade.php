{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('content')
<div class="relative bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 mb-8 text-white shadow-lg overflow-hidden">
    <div class="relative z-10">
        <h1 class="text-2xl md:text-3xl font-bold mb-2">
            Hallo <span class="font-bold text-yellow-500">{{ $user->username ?? '' }}</span> 
        </h1>
        <h1 class="text-2xl font-bold mb-4">Statistik Bulan  <span class="font-bold text-yellow-500"> {{ now()->translatedFormat('F') }}</span></h1>
        <p class="text-base mb-3">
            Pantau aktivitas terkini dan kelola data transaksi penjualan Anda di sini.
        </p>
    </div>
    <div class="absolute right-0 top-0 h-full w-1/3 bg-white opacity-10 transform skew-x-12 translate-x-10"></div>
</div>

<div class="grid grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
        <div class="flex justify-between items-start mb-2">
            <p class="text-gray-500 text-sm font-medium">Jumlah Sales</p>
            <div class="p-1 bg-blue-100 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M18 21a8 8 0 0 0-16 0"/>
                    <circle cx="10" cy="8" r="5"/>
                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-800">{{ $totalSales }} <span class="text-xl font-medium text-gray-500">Sales</span></div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
        <div class="flex justify-between items-start mb-2">
            <p class="text-gray-500 text-sm font-medium">Total Transaksi</p>
            <div class="p-1 bg-blue-100 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <rect width="20" height="12" x="2" y="6" rx="2"/>
                    <circle cx="12" cy="12" r="2"/>
                    <path d="M6 12h.01M18 12h.01"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-800">{{ $totalTransaksi }} <span class="text-xl font-medium text-gray-500">Transaksi</span></div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
        <div class="flex justify-between items-start mb-2">
            <p class="text-gray-500 text-sm font-medium">Jumlah Unit Terjual</p>
            <div class="p-1 bg-blue-100 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M2.97 12.92A2 2 0 0 0 2 14.63v3.24a2 2 0 0 0 .97 1.71l3 1.8a2 2 0 0 0 2.06 0L12 19v-5.5l-5-3-4.03 2.42Z"/>
                    <path d="m7 16.5-4.74-2.85"/>
                    <path d="m7 16.5 5-3"/>
                    <path d="M7 16.5v5.17"/>
                    <path d="M12 13.5V19l3.97 2.38a2 2 0 0 0 2.06 0l3-1.8a2 2 0 0 0 .97-1.71v-3.24a2 2 0 0 0-.97-1.71L17 10.5l-5 3Z"/>
                    <path d="m17 16.5-5-3"/>
                    <path d="m17 16.5 4.74-2.85"/>
                    <path d="M17 16.5v5.17"/>
                    <path d="M7.97 4.42A2 2 0 0 0 7 6.13v4.37l5 3 5-3V6.13a2 2 0 0 0-.97-1.71l-3-1.8a2 2 0 0 0-2.06 0l-3 1.8Z"/>
                    <path d="M12 8 7.26 5.15"/>
                    <path d="m12 8 4.74-2.85"/>
                    <path d="M12 13.5V8"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-800">{{ $totalUnitBulanIni }} <span class="text-xl font-medium text-gray-500">Unit</span></div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
        <div class="flex justify-between items-start mb-2">
            <p class="text-gray-500 text-sm font-medium">Total Penjualan</p>
            <div class="p-1 bg-blue-100 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M12 16v5"/>
                    <path d="M16 14v7"/>
                    <path d="M20 10v11"/>
                    <path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/>
                    <path d="M4 18v3"/>
                    <path d="M8 14v7"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
    </div>
</div>
<div class="bg-white p-6 rounded-xl shadow mb-8">

    <h3 class="text-sm font-semibold text-gray-700 mb-4">

        Penjualan Bulanan

    </h3>
    <canvas id="salesChart" height="56"></canvas>

</div>



<div class="bg-white p-6 rounded-2xl shadow-lg">

   

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-xl font-bold text-gray-800">Semua Sales</h2>

            <p class="text-sm text-green-600">Rank sales dengan penjualan terbesar</p>

        </div>

    </div>



    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Terjual</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komisi</th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Gaji</th>

                </tr>

            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

                @foreach ($topSales as $index => $trx)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            <div class="flex items-center">

                                <span class="flex items-center justify-center w-6 h-6 rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-500' }} text-xs font-bold mr-3">

                                    {{ $index + 1 }}

                                </span>

                                {{ $trx->sales->nama_lengkap ?? 'Sales Terhapus' }}

                            </div>

                        </td>



                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">

                            {{ $trx->total_unit }} Unit

                        </td>



                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold">

                            Rp {{ number_format($trx->total_omset, 0, ',', '.') }}

                        </td>



                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">

                            Rp {{ number_format($trx->total_komisi, 0, ',', '.') }}

                        </td>



                        <td class="px-6 py-4 whitespace-nowrap">

                            @if($index == 0)

                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">

                                    👑 Top Sales

                                </span>

                            @else

                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">

                                    Aktif

                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>  
    <div class="mt-4 text-sm text-gray-500">
        Showing data Top Sales
    </div>
</div>





<script>
    function selectSort(value) {
        document.getElementById('sortLabel').innerText = value;
        toggleSortDropdown();
    }

    function toggleSortDropdown() {
        const dropdown = document.getElementById('sortDropdown');
        const icon = document.getElementById('sortIcon');
        
        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('sortButton');
        const dropdown = document.getElementById('sortDropdown');
        const icon = document.getElementById('sortIcon');

        button.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSortDropdown();
        });

        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        });
    });
</script>

<script>
    window.chartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
        revenue: @json($grafikRevenue),
        unit: @json($grafikUnit)
    };
</script>

@endsection
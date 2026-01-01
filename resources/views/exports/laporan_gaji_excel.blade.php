<table>
    <thead>
        <tr>
            <th colspan="8" style="font-weight: bold; font-size: 14px; text-align: center; height: 30px; vertical-align: middle;">
                LAPORAN REKAP GAJI SALES
            </th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold;">
                Periode: {{ \Carbon\Carbon::create()->month((int) $bulan)->translatedFormat('F') }} {{ $tahun }}
            </th>
        </tr>
        <tr></tr> 
        <tr>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center; width: 50px;">No</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: left; width: 200px;">Nama Sales</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: right; width: 120px;">Gaji Pokok</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center; width: 100px;">Jml Transaksi</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: center; width: 100px;">Unit Terjual</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: right; width: 150px;">Total Omset</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: right; width: 120px;">Komisi</th>
            <th style="font-weight: bold; border: 1px solid #000000; text-align: right; width: 150px;">Total Gaji</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $row)
        <tr>
            <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000000; text-align: left;">{{ $row->nama_lengkap }}</td>
            <td style="border: 1px solid #000000; text-align: right;">{{ $row->gaji_pokok }}</td>
            <td style="border: 1px solid #000000; text-align: center;">{{ $row->total_transaksi }}</td>
            <td style="border: 1px solid #000000; text-align: center;">{{ $row->total_unit }}</td>
            <td style="border: 1px solid #000000; text-align: right;">{{ $row->total_omset }}</td>
            <td style="border: 1px solid #000000; text-align: right;">{{ $row->total_komisi }}</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;">
                {{ $row->gaji_pokok + $row->total_komisi }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
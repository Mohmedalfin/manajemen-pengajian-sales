<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BarangRequest;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        $produk = $query->orderBy('nama_produk')->paginate(20);
        return view('admin.data-barang', compact('produk'));
    }

    public function store(BarangRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Barang::create($data);
        return redirect()->back()->with('success', 'Data barang berhasil ditambahkan');    
    }

    public function update(BarangRequest $request, Barang $barang): RedirectResponse
    {
        $barang->update($request->validated());
        return redirect()->back()->with('success', 'Data barang berhasil diedit');
    }

    public function destroy($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->back()->with('success', 'Data barang berhasil dihapus');
    }
}

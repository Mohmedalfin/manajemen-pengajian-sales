<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Sales;
use App\Http\Requests\SalesRequest;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Sales::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        $sales = $query->orderByDesc('id')->paginate(10);

        return view('admin.data-sales', compact('sales'));
    }

    public function store(SalesRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Sales::create($data);
        return redirect()->back()->with('success', 'Data sales berhasil ditambahkan');    
    }  

    public function update(SalesRequest $request, $id): RedirectResponse
    {
        $sales = Sales::findOrFail($id);
        $sales->update($request->validated());
        return redirect()->back()->with('success', 'Data sales berhasil diupdate');
    }  

    public function destroy($id)
    {
        $sales = Sales::findOrFail($id);
        $sales->delete();
        return redirect()->back()->with('success', 'Data sales berhasil didelete');    
    }  
}

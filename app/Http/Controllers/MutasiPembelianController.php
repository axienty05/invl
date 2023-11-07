<?php

namespace App\Http\Controllers;

use App\Models\MTMutasi;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MutasiPembelianController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $pembelian = MTMutasi::where(function ($query) use ($search) {
            $query->where('no_mutasi', 'like', "%$search%")
                ->orWhere('tgl_mutasi', 'like', "%$search%")
                ->orWhere('jenis_mutasi', 'like', "%$search%")
                ->orWhereHas('supplier', function ($query) use ($search) {
                    $query->where('nama_supplier', 'like', "%$search%");
                });
        })->whereIn('jenis_mutasi', ['pembelian', 'penjualan'])->paginate(10);
        return view('admin.mutasi.pembelian.index', [
            'title' => 'Data Mutasi',
            'pembelians' => $pembelian
        ]);
    }

    public function create(): View
    {
        return view('admin.mutasi.pembelian.create', [
            'suppliers' => Supplier::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'no_mutasi' => 'required',
            'm_supplier_id' => 'required',
            'jenis_mutasi' => 'required|in:pembelian,penjualan',
            'keterangan' => 'nullable',
            'tgl_mutasi' => 'required',
            'dtMutasis.*.m_barang_id' => 'required',
            'dtMutasis.*.pemakai_lama' => 'required',
            'dtMutasis.*.harga' => 'required',
        ]);

        $mtmutasi = MTMutasi::create($validatedData);

        foreach ($request->dtMutasis as $detail) {
            $detail['mt_mutasi_id'] = $mtmutasi->id;
            $mtmutasi->dtmutasis()->create([
                'm_barang_id' => $detail['m_barang_id'],
                'pemakai_baru' => $detail['pemakai_baru'] ?? null,
                'pemakai_lama' => $detail['pemakai_lama'],
                'harga' => $detail['harga'],
            ]);
        }

        return redirect('/admin/mutasi/pembelian/create')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id): View
    {
        $mtmutasi = MTMutasi::with('dtmutasis')
            ->where(function ($query) {
                $query->where('jenis_mutasi', 'pembelian')
                    ->orWhere('jenis_mutasi', 'penjualan');
            })
            ->findOrFail($id);
        $dtmutasis = $mtmutasi->dtmutasis;

        return view('admin.mutasi.pembelian.show', [
            'title' => 'Detail Mutasi',
            'mtmutasi' => $mtmutasi,
            'dtmutasis' => $dtmutasis
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id): RedirectResponse
    {
        $mtmutasi = MTMutasi::where('jenis_mutasi', 'pembelian')
            ->orWhere('jenis_mutasi', 'penjualan')
            ->findOrFail($id);
        $mtmutasi->dtmutasis()->delete();
        $mtmutasi->delete();
        return redirect('/admin/mutasi/pembelian')->with('success', 'Data berhasil dihapus!');
    }
}

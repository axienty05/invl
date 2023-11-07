<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MTMutasi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MutasiPerpindahanController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $perpindahan = MTMutasi::where(function ($query) use ($search) {
            $query->where('no_mutasi', 'like', "%$search%")
                ->orWhere('tgl_mutasi', 'like', "%$search%")
                ->orWhere('jenis_mutasi', 'like', "%$search%")
                ->orWhereHas('supplier', function ($query) use ($search) {
                    $query->where('nama_supplier', 'like', "%$search%");
                });
        })->where('jenis_mutasi', 'perpindahan')->paginate(10);
        return view('admin.mutasi.perpindahan.index', [
            'title' => 'Data Mutasi',
            'perpindahans' => $perpindahan
        ]);
    }

    public function create(): View
    {
        return view('admin.mutasi.perpindahan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'no_mutasi' => 'required',
            'm_supplier_id' => 'nullable',
            'jenis_mutasi' => 'in:perpindahan',
            'keterangan' => 'nullable',
            'tgl_mutasi' => 'required'
        ]);

        $mtmutasi = MTMutasi::create($validatedData);

        foreach ($request->dtMutasis as $detail) {
            $detail['mt_mutasi_id'] = $mtmutasi->id;
            $newDetail = $mtmutasi->dtmutasis()->create([
                'm_barang_id' => $detail['m_barang_id'],
                'pemakai_baru' => $detail['pemakai_baru'] ?? null,
                'pemakai_lama' => $detail['pemakai_lama'],
                'harga' => $detail['harga'],
            ]);

            $this->updateMBarang($newDetail->m_barang_id, $newDetail->pemakai_baru);
        }

        return redirect('/admin/mutasi/perpindahan/create')->with('success', 'Databerhasil disimpan!');
    }

    public function updateMBarang($m_barang_id, $pemakai_baru = null)
    {
        $m_barang = Barang::find($m_barang_id);
        if ($m_barang && !is_null($pemakai_baru)) {
            $m_barang->m_pemakai_id = $pemakai_baru;
            $m_barang->save();
        }
    }

    public function show(string $id): View
    {
        $mtmutasi = MTMutasi::where('jenis_mutasi', 'perpindahan')
            ->findOrFail($id);
        $dtmutasis = $mtmutasi->dtmutasis;

        return view('admin.mutasi.perpindahan.show', [
            'title' => 'Detail Mutasi',
            'mtmutasi' => $mtmutasi,
            'dtmutasis' => $dtmutasis
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id): RedirectResponse
    {
        $mtmutasi = MTMutasi::where('jenis_mutasi', 'perpindahan')
            ->findOrFail($id);
        $mtmutasi->dtmutasis()->delete();
        $mtmutasi->delete();
        return redirect('/admin/mutasi/perpindahan')->with('success', 'Data berhasil dihapus!');
    }
}

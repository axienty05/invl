<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Enums\Kategori;
use App\Models\Pemakai;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Enum;

class BarangController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.barang.index');
    }

    public function create(): View
    {
        return view('admin.barang.create', [
            'title' => 'Form Tambah Data',
            'pemakais' => Pemakai::all(),
            'kodeBarang' => $this->generateKodeBarang()
        ]);
    }

    public function generateKodeBarang()
    {
        $lastCode = Barang::orderBy('created_at', 'desc')->pluck('kode_barang')->first();

        $suffix = ($lastCode) ? intval(substr($lastCode, -5)) + 1 : 1;

        $kodeBarang = 'B' . '/' . str_pad($suffix, 5, '0', STR_PAD_LEFT);

        return $kodeBarang;
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|max:8|unique:m_barangs',
            'nama_barang' => 'required|max:100',
            'serial_number' => 'required|unique:m_barangs|max:50',
            'm_pemakai_id' => 'required',
            'kategori' => ['required', new Enum(Kategori::class)],
            'harga' => 'nullable',
            'keterangan' => 'nullable|max:255',
            'status' => 'required|in:aktif,tidak_aktif,sedang_service',
        ]);

        $kodeBarang = $this->generateKodeBarang();

        $validatedData['kode_barang'] = $kodeBarang;

        Barang::create($validatedData);
        return redirect('/admin/barang')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Barang $barang): View
    {
        return view('admin.barang.edit', [
            'title' => 'Form Edit Barang',
            'pemakais' => Pemakai::all(),
            'barang' => $barang
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|max:8',
            'nama_barang' => 'required|max:100',
            'serial_number' => 'required|max:50',
            'm_pemakai_id' => 'required',
            'kategori' => [new Enum(Kategori::class)],
            'harga' => 'nullable',
            'keterangan' => 'nullable|max:255',
            'status' => 'in:aktif,tidak_aktif,sedang_service',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->fill($validatedData);
        $barang->save();
        return redirect('/admin/barang')->with('success', 'Data berhasil di update!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect('/admin/barang')->with('success', 'Data berhasil dihapus!');
    }
}
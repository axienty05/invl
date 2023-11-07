<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $supplier = Supplier::where(function ($query) use ($search) {
            $query->where('nama_supplier', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%")
                ->orWhere('no_telp', 'like', "%$search")
                ->orWhere('cp', 'like', "%$search%");
        })->latest()->paginate(25);
        return view('admin.supplier.index', [
            'title' => 'Data Supplier',
            'suppliers' => $supplier
        ]);
    }

    public function create(): View
    {
        return view('admin.supplier.create', [
            'title' => 'Form Tambah Data',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:100',
            'email' => 'required',
            'no_telp' => 'required|unique:m_suppliers',
            'cp' => 'required',
            'no_hp' => 'required',
            'keterangan' => 'nullable|max:200'
        ]);

        Supplier::create($validatedData);
        return redirect('/admin/supplier')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(Supplier $supplier): View
    {
        return view('admin.supplier.edit', [
            "title" => "Edit Data Supplier",
            "supplier" => $supplier
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_supplier' => 'required|max:50',
            'alamat' => 'required|max:100',
            'email' => 'required',
            'no_telp' => 'required',
            'cp' => 'required',
            'no_hp' => 'required',
            'keterangan' => 'required|max:200'
        ]);
        $supplier = Supplier::findOrFail($id);
        $supplier->fill($validatedData);
        $supplier->save();
        return redirect('/admin/supplier')->with('success', 'Data berhasil di update!');
    }


    public function destroy(string $id): RedirectResponse
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect('/admin/supplier')->with('success', 'Data berhasil dihapus!');
    }
}
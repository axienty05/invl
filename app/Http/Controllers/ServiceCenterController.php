<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use Illuminate\Http\RedirectResponse;

class ServiceCenterController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $servicecenter = ServiceCenter::where(function ($query) use ($search) {
            $query->where('nama_service', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%")
                ->orWhere('no_telp', 'like', "%$search")
                ->orWhere('cp', 'like', "%$search%");
        })->latest()->paginate(10);
        return view('admin.servicecenter.index', [
            'title' => 'Data Service Center',
            'servicecenters' => $servicecenter
        ]);
    }

    public function create(): View
    {
        return view('admin.servicecenter.create', [
            'title' => 'Form Tambah Data',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_service' => 'required|max:50',
            'alamat' => 'required|max:100',
            'no_telp' => 'required|unique:m_service_centers',
            'cp' => 'nullable|max:50',
            'no_hp' => 'nullable|max:20',
            'keterangan' => 'nullable|max:200'
        ]);

        ServiceCenter::create($validatedData);
        return redirect('/admin/servicecenter')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(ServiceCenter $servicecenter): View
    {
        return view('admin.servicecenter.edit', [
            'title' => "Form edit service center",
            'servicecenter' => $servicecenter
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_service' => 'required|max:50',
            'alamat' => 'required|max:100',
            'no_telp' => 'required',
            'cp' => 'nullable|max:50',
            'no_hp' => 'nullable|max:20',
            'keterangan' => 'nullable|max:200'
        ]);

        $servicecenter = ServiceCenter::findOrFail($id);
        $servicecenter->fill($validatedData);
        $servicecenter->save();
        return redirect('/admin/servicecenter')->with('success', 'Data berhasil di update!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $servicecenter = ServiceCenter::findOrFail($id);
        $servicecenter->delete();
        return redirect('/admin/servicecenter')->with('success', 'Data berhasil dihapus!');
    }
}
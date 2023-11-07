<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pemakai;
use App\Models\Service;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ServiceCenter;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.service.index');
    }

    public function create(): View
    {
        return view('admin.service.create', [
            'title' => 'Form Tambah Data',
            'barangs' => Barang::all(),
            'pemakais' => Pemakai::all(),
            'servicecenter' => ServiceCenter::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        dd($request);
        $validatedData = $request->validate([
            'no_sj' => 'required|unique:m_services',
            'm_pemakai_id' => 'required',
            'm_barang_id' => 'required',
            'm_service_center_id' => 'required',
            'tgl_service' => 'required',
            'tgl_selesai' => 'nullable',
            'biaya' => 'nullable',
            'kerusakan' => 'required',
            'analisa' => 'nullable',
            'solusi' => 'nullable'
        ]);

        Service::create($validatedData);
        return redirect('/admin/service')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Service $service): View
    {
        return view('admin.service.edit', [
            'title' => 'Form Edit Service',
            'barangs' => Barang::all(),
            'pemakais' => Pemakai::all(),
            'servicecenters' => ServiceCenter::all(),
            'service' => $service
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'no_sj' => 'required',
            'm_service_center_id' => 'required',
            'tgl_service' => 'required',
            'tgl_selesai' => 'nullable',
            'biaya' => 'nullable',
            'kerusakan' => 'required',
            'analisa' => 'nullable',
            'solusi' => 'nullable'
        ]);

        $service = Service::findOrFail($id);
        $service->fill($validatedData);
        $service->save();
        return redirect('/admin/service')->with('success', 'Data berhasil di update!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect('/admin/service')->with('success', 'Dara berhasil di hapus!');
    }
}
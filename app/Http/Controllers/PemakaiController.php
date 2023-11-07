<?php

namespace App\Http\Controllers;

use App\Models\Pemakai;
use App\Enums\Department;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Enum;

class PemakaiController extends Controller
{
    public function index(): View
    {
        return view('admin.pemakai.index');
    }

    public function create(): View
    {
        return view('admin.pemakai.create', [
            'title' => 'Form Tambah Data'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|unique:m_pemakais',
            'department' => ['required', new Enum(Department::class)]
        ]);

        Pemakai::create($validatedData);
        return redirect('/admin/pemakai')->with('success', 'Data berhasil disimpan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Pemakai $pemakai): View
    {
        return view('admin.pemakai.edit', [
            "title" => "Form Edit Pemakai",
            "pemakai" => $pemakai
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3',
            'department' => [new Enum(Department::class)]
        ]);

        $pemakai = Pemakai::findOrFail($id);
        $pemakai->fill($validatedData);
        $pemakai->save();
        return redirect('/admin/pemakai')->with('success', 'Data berhasil di update!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $pemakai = Pemakai::findOrFail($id);
        $pemakai->delete();
        return redirect('/admin/pemakai')->with('success', 'Data berhasil dihapus!');
    }
}
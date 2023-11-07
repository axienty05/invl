@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('supplier.index') }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search ..."
                                    aria-label="search" aria-describedby="button-addon2" value="">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon3">
                                    <i class="bx bx-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-primary alert-dismissible mt-3 mb-0" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm mt-3 mb-3">
                        <thead class="table text-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>CP</th>
                                <th>No. HP</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $number = ($suppliers->currentPage() - 1) * $suppliers->perPage();
                            $totalBiaya = 0; // Variabel untuk mengakumulasi total biaya
                            @endphp
                            @forelse ($suppliers as $supplier)
                            <tr class="text-sm">
                                <td>{{ ++$number }}</td>
                                <td>{{ $supplier->nama_supplier }}</td>
                                <td>{{ substr($supplier->alamat, 0, 20) }}{{ strlen($supplier->alamat) > 20 ? '...' : ''
                                    }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->no_telp }}</td>
                                <td>{{ $supplier->cp }}</td>
                                <td>{{ $supplier->no_hp }}</td>
                                <td>{{ substr($supplier->keterangan, 0, 20) }}{{ strlen($supplier->keterangan) > 20 ?
                                    '...' : '' }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('supplier.edit', $supplier->id) }}">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
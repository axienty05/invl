@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header"><strong>{{ $title }}</strong></h4>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('perpindahan.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('perpindahan.index') }}" method="GET" class=" mb-3">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search ..."
                                    aria-label="search" aria-describedby="button-addon2"
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon3"> <i
                                        class="bx bx-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-primary alert-dismissible mt-3 mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover mb-3">
                        <thead class="table">
                            <th>No</th>
                            <th>No Mutasi</th>
                            <th>Jenis Mutasi</th>
                            <th>Supplier</th>
                            <th>Tanggal Mutasi</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($perpindahans as $perpindahan)
                            <tr class="text-sm">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perpindahan->no_mutasi }}</td>
                                <td>{{ $perpindahan->jenis_mutasi }}</td>
                                <td>{{ $perpindahan->supplier->nama_supplier }}</td>
                                <td>{{ $perpindahan->tgl_mutasi->format('d M Y') }}</td>
                                <td>{!! $perpindahan->keterangan !!}</td>
                                <td>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('perpindahan.show', $perpindahan->id) }}"><i
                                            class="bx bx-show-alt"></i> </a>
                                    <form action="{{ route('perpindahan.destroy', $perpindahan->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')"><i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $perpindahans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
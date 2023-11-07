@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="/admin/supplier/{{ $supplier->id }}" class="mb-5">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                    id="nama_supplier" name="nama_supplier" autofocus
                                    value="{{ old('nama_supplier', $supplier->nama_supplier) }}">
                                @error('nama_supplier')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $supplier->email) }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" value="{{ old('alamat', $supplier->alamat) }}">
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="no_telp" class="form-label">No Telp</label>
                                <input type="text" min="0" class="form-control @error('no_telp') is-invalid @enderror"
                                    id="no_telp" name="no_telp" value="{{ old('no_telp', $supplier->no_telp) }}">
                                @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="cp" class="form-label">Contact Person</label>
                                <input type="text" class="form-control @error('cp') is-invalid @enderror" id="cp"
                                    name="cp" value="{{ old('cp', $supplier->cp) }}">
                                @error('cp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="no_hp" class="form-label">No hp</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" value="{{ old('no_hp', $supplier->no_hp) }}">
                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                id="keterangan"
                                rows="3">{{ old('keterangan', $supplier->keterangan ?? null) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm float-right mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

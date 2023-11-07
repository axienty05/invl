@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="/admin/servicecenter/{{ $servicecenter->id }}" class="mb-5"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_service" class="form-label">Nama service</label>
                                <input type="text" class="form-control @error('nama_service') is-invalid @enderror"
                                    id="nama_service" name="nama_service" required autofocus
                                    value="{{ old('nama_service', $servicecenter->nama_service) }}">
                                @error('nama_service')
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
                                    id="alamat" name="alamat" required autofocus
                                    value="{{ old('alamat', $servicecenter->alamat) }}">
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
                                    id="no_telp" name="no_telp" required autofocus
                                    value="{{ old('no_telp', $servicecenter->no_telp) }}">
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
                                    name="cp" required autofocus value="{{ old('cp', $servicecenter->cp) }}">
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
                                    name="no_hp" required autofocus value="{{ old('no_hp', $servicecenter->no_hp) }}">
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
                                rows="3">{{ old('keterangan', $servicecenter->keterangan ?? null) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm float-right mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

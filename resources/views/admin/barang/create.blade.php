@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('barang.store') }}" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control @error('kode_barang') is-invalid @enderror"
                            id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $kodeBarang) }}">
                        @error('kode_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                                    id="serial_number" name="serial_number" value="{{ old('serial_number') }}">
                                @error('serial_number')
                                <div class="invalid-feedback text-small">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="m_pemakai_id" class="form-label">Pemakai</label>
                        <select class="form-select select2 @error('m_pemakai_id') is-invalid @enderror"
                            id="select-pemakai" name="m_pemakai_id">
                            <option value="" disabled selected>Pilih pemakai</option>
                            @foreach ($pemakais as $pemakai)
                            @if(old('m_pemakai_id') == $pemakai->id)
                            <option value="{{ $pemakai->id }}" selected>{{ $pemakai->nama }}</option>
                            @else
                            <option value="{{ $pemakai->id }}">{{ $pemakai->nama }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('m_pemakai_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select select2 @error('kategori') is-invalid @enderror" name="kategori"
                            id="select-kategori">
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach(\App\Enums\Kategori::cases() as $kategori)
                            <option value="{{ $kategori->value }}" @if(old('kategori')==$kategori->value)
                                selected @endif>{{ $kategori->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" min="0" value="{{ old('harga') }}">
                        @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="" disabled selected>Pilih status</option>
                            <option value="aktif" {{ old('status')=='aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak_aktif" {{ old('status')=='tidak_aktif' ? 'selected' : '' }}>
                                Tidak Aktif</option>
                            <option value="sedang_service" {{ old('status')=='sedang_service' ? 'selected' : '' }}>
                                Sedang Service</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm float-right mt-3">Batal</a>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

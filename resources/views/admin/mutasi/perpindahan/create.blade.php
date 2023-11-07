@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Form Mutasi Perpindahan</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('perpindahan.store') }}" class="mb-5"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="no_mutasi" class="form-label">No Mutasi</label>
                                <input type="text" wire:model="no_mutasi"
                                    class="form-control @error('no_mutasi') is-invalid @enderror" id="no_mutasi"
                                    name="no_mutasi" autofocus value="{{ old('no_mutasi') }}">
                                @error('no_mutasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="tgl_mutasi" class="form-label">Tanggal Mutasi</label>
                                <input type="date" wire:model="tgl_mutasi" name="tgl_mutasi" id="tgl_mutasi"
                                    class="form-control @error('tgl_mutasi') is-invalid @enderror"
                                    value="{{ old('tgl_mutasi') }}">
                                @error('tgl_mutasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis_mutasi" class="form-label">Jenis mutasi</label>
                        <select class="form-control" id="jenis_mutasi" name="jenis_mutasi">
                            <option value="perpindahan" {{ old('jenis_mutasi')=='perpindahan' ? 'selected' : '' }}>
                                Perpindahan</option>
                        </select>
                        @error('jenis_mutasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                            id="keterangan" rows="3"></textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <livewire:mutasi-perpindahan />

                    <div>
                        <input class="btn btn-primary btn-sm mt-3" type="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Form Mutasi</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('pembelian.store') }}" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="no_mutasi" class="form-label">No Mutasi</label>
                                <input type="text" wire:model="no_mutasi"
                                    class="form-control @error('no_mutasi') is-invalid @enderror" name="no_mutasi"
                                    autofocus value="{{ old('no_mutasi') }}">
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
                                <input type="date" wire:model="tgl_mutasi" name="tgl_mutasi"
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

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="jenis_mutasi" class="form-label">Jenis mutasi</label>
                                <select class="form-control @error('jenis_mutasi') is-invalid @enderror"
                                    name="jenis_mutasi">
                                    <option selected disabled>Pilih jenis mutasi</option>
                                    <option value="pembelian" {{ old('jenis_mutasi')=='pembelian' ? 'selected' : '' }}>
                                        Pembelian</option>
                                    <option value="penjualan" {{ old('jenis_mutasi')=='penjualan' ? 'selected' : '' }}>
                                        Penjualan</option>
                                </select>
                                @error('jenis_mutasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="m_supplier_id" class="form-label">Supplier</label>
                                <select class="form-select @error('m_supplier_id') is-invalid @enderror"
                                    name="m_supplier_id" required>
                                    <option selected disabled>Pilih supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('m_supplier_id')==$supplier->id ?
                                        'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                                    @endforeach
                                </select>
                                @error('m_supplier_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
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

                    <livewire:mutasi-pembelian />

                    <div>
                        <input class="btn btn-primary btn-sm mt-3" type="submit" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
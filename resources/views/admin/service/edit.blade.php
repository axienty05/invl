@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="/admin/service/{{ $service->id }}" class="mb-5"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="no_sj" class="form-label">No Surat Jalan</label>
                        <input type="text" class="form-control @error('no_sj') is-invalid @enderror" id="no_sj"
                            name="no_sj" required readonly value="{{ old('no_sj', $service->no_sj) }}">
                        @error('no_sj')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="m_pemakai_id" class="form-label">Pemakai</label>
                                <select disabled class="form-select @error('m_pemakai_id') is-invalid @enderror"
                                    name="m_pemakai_id" id="m_pemakai_id">
                                    @foreach ($pemakais as $pemakai)
                                    @if(old('m_pemakai_id', $service->m_pemakai_id) == $pemakai->id)
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
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="m_barang_id" class="form-label">Nama Barang</label>
                                <select disabled class="form-control @error('m_barang_id') is-invalid @enderror"
                                    name="m_barang_id" id="m_barang_id" required>
                                    @foreach ($barangs as $barang)
                                    @if(old('m_barang_id', $service->m_barang_id) == $barang->id)
                                    <option value="{{ $barang->id }}" selected>{{ $barang->nama_barang }}</option>
                                    @else
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('m_barang_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="m_service_center_id" class="form-label">Tempat</label>
                        <select class="form-select @error('m_service_center_id') is-invalid @enderror"
                            id="select-tempat" name="m_service_center_id" null value="{{ old('m_service_center_id') }}">
                            <option selected disabled>Pilih tempat</option>
                            @foreach ($servicecenters as $servicecenter)
                            @if(old('m_service_center_id', $service->m_service_center_id) == $servicecenter->id)
                            <option value="{{ $servicecenter->id }}" selected>{{ $servicecenter->nama_service }}
                            </option>
                            @else
                            <option value="{{ $servicecenter->id }}">{{ $servicecenter->nama_service }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('m_service_center_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="biaya" class="form-label">Harga</label>
                        <input type="biaya" class="form-control @error('biaya') is-invalid @enderror" id="biaya"
                            name="biaya" value="{{ old('biaya', $service->biaya) }}">
                        @error('biaya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="tgl_service" class="form-label">Tanggal Service</label>
                                <input type="date" name="tgl_service" id="tgl_service"
                                    class="form-control @error('tgl_service') is-invalid @enderror"
                                    value="{{ old('tgl_service', $service->tgl_service->format('Y-m-d')) }}">
                                @error('tgl_service')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" id="tgl_selesai"
                                    class="form-control @error('tgl_selesai') is-invalid @enderror"
                                    value="{{ old('tgl_selesai', optional($service->tgl_selesai)->format('Y-m-d')) }}">
                                @error('tgl_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kerusakan" class="form-label">Kerusakan</label>
                        <textarea class="form-control @error('kerusakan') is-invalid @enderror" name="kerusakan"
                            id="kerusakan" rows="3">{{ old('kerusakan', $service->kerusakan ?? null) }}</textarea>
                        @error('kerusakan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="analisa" class="form-label">Analisa</label>
                            <textarea class="form-control @error('analisa') is-invalid @enderror" name="analisa"
                                id="analisa" rows="3">{{ old('analisa', $service->analisa ?? null) }}</textarea>
                            @error('analisa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="solusi" class="form-label">Solusi</label>
                            <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi"
                                id="solusi">{{ old('solusi', $service->solusi ?? null) }}</textarea>
                            @error('solusi')
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

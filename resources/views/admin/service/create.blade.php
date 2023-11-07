@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('service.store') }}" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="no_sj" class="form-label">No Surat Jalan</label>
                                <input type="text" class="form-control @error('no_sj') is-invalid @enderror" id="no_sj"
                                    name="no_sj" autofocus value={{ old('no_sj') }}>
                                @error('no_sj')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <livewire:dropdown-dependent />

                    <div class="form-group mb-3">
                        <label for="m_service_center_id" class="form-label">Tempat</label>
                        <select class="form-select @error('m_service_center_id') is-invalid @enderror"
                            id="select-tempat" name="m_service_center_id">
                            <option selected disabled>Pilih tempat</option>
                            @foreach ($servicecenter as $servicecenter)
                            @if(old('m_service_center_id') == $servicecenter->id)
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

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="biaya" class="form-label">Biaya</label>
                                <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                    id="biaya" name="biaya" value="{{ old('biaya') }}">
                                @error('biaya')
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
                                <label for="tgl_service" class="form-label">Tanggal Service</label>
                                <input type="date" name="tgl_service" id="tgl_service"
                                    class="form-control @error('tgl_service') is-invalid @enderror"
                                    value="{{ old('tgl_service') }}">
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
                                    value="{{ old('tgl_selesai') }}">
                                @error('tgl_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kerusakan" class="form-label">Kerusakan</label>
                        <textarea class="form-control @error('kerusakan') is-invalid @enderror" name="kerusakan"
                            id="kerusakan" rows="3">{{ old('kerusakan', $service->kerusakan ?? null) }}</textarea>
                        @error('kerusakan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="analisa" class="form-label">Analisa</label>
                        <textarea class="form-control @error('analisa') is-invalid @enderror" name="analisa"
                            id="analisa" rows="3"></textarea>
                        @error('analisa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="solusi" class="form-label">Solusi</label>
                        <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" id="solusi"
                            rows="3"></textarea>
                        @error('solusi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
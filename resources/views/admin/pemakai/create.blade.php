@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('pemakai.store') }}" class="mb-5" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-5 mb-2">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Pemakai</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" autofocus value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select @error('department') is-invalid @enderror" name="department">
                                    <option value="" disabled selected>Pilih bagian</option>
                                    @foreach(\App\Enums\Department::cases() as $department)
                                    <option value="{{ $department->value }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
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
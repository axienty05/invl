@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('servicecenter.create') }}" class="btn btn-primary btn-sm mb-3">Tambah
                            Data</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('servicecenter.index') }}" method="GET" class="mb-2">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" placeholder="Search ..."
                                    aria-label="search" aria-describedby="button-addon2"
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit" id="button-addon3"><i
                                        class="bx bx-search"></i></button>
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
                    <table class="table table-striped table-hover mt-3 mb-3">
                        <thead class="table text-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Service</th>
                                <th>Alamat</th>
                                <th>NoTelp</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $number = ($servicecenters->currentPage() - 1) * $servicecenters->perPage();
                            @endphp
                            @forelse ($servicecenters as $servicecenter)
                            <tr class="text-sm">
                                <td>{{ ++$number }}</td>
                                <td>{{ $servicecenter->nama_service }}</td>
                                <td>{{ substr($servicecenter->alamat, 0, 20) }}{{ strlen($servicecenter->alamat) > 20 ?
                                    '...' : '' }}</td>
                                <td>{{ $servicecenter->no_telp }}</td>
                                <td>{{ substr($servicecenter->keterangan, 0, 20) }}{{ strlen($servicecenter->keterangan)
                                    > 20 ? '...' : '' }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('servicecenter.edit', $servicecenter->id) }}"><i
                                            class="bx bx-edit-alt"></i></a>
                                    <form action="{{ route('servicecenter.destroy', $servicecenter->id) }}"
                                        method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')"><i
                                                class="bx bx-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- {!! $servicecenters->appends(\Request::except('page'))->render() !!} --}}
                    {{ $servicecenters->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

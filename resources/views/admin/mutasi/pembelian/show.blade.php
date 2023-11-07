@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header"><strong>{{ $title }}</strong></h4>
            <div class="card-body">
                <div class="table-responsive text-nowrap mb-3">
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <th class="col-2">No Mutasi</th>
                                <td><span class="px-3">:</span>{{ $mtmutasi->no_mutasi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Mutasi</th>
                                <td><span class="px-3">:</span>{{ $mtmutasi->tgl_mutasi->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td><span class="px-3">:</span>{{ $mtmutasi->supplier->nama_supplier }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Mutasi</th>
                                <td><span class="px-3">:</span>{{ $mtmutasi->jenis_mutasi }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td><span class="px-3">:</span>{{ $mtmutasi->keterangan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover mb-3">
                        <thead class="table-secondary">
                            <th>No</th>
                            <th>Barang</th>
                            <th>Pemakai</th>
                            {{-- <th>Pemakai Baru</th> --}}
                            <th>Harga</th>
                        </thead>
                        <tbody>
                            @php
                            $totalBiaya = 0; // Variabel untuk mengakumulasi total biaya
                            @endphp
                            @forelse ($dtmutasis as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>{{ $detail->pemakaiLama->nama }}</td>
                                {{-- <td>{{ $detail->pemakaiBaru->nama }}</td> --}}
                                <td>@currency($detail->harga)</td>
                                @php
                                $totalBiaya += $detail->harga; // Menambahkan biaya pada variabel totalBiaya
                                @endphp
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Data tidak ada</td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="3">Total : </td>
                                <td>@currency($totalBiaya)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm float-right mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
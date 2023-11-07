<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                <div class="row mb-3">
                    {{-- <div class="col-sm-2 mb-2">
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-filter-alt"></i></span>
                            <select id="inputState" class="form-select">
                                <option selected>All</option>
                                <option>Kategori</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-sm-4">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input wire:model.live.debounce.300ms="search" type="text" class="form-control"
                                placeholder="Search..." aria-label="Search..."
                                aria-describedby="basic-addon-search31" />
                        </div>
                    </div>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-primary alert-dismissible mt-3 mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-hover mb-3">
                        <thead class="table">
                            <tr>
                                <th>
                                    No
                                </th>
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'kode_barang',
                                'displayName' => 'Kode'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'm_pemakai_id',
                                'displayName' => 'Pemakai'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'nama_barang',
                                'displayName' => 'Nama'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'serial_number',
                                'displayName' => 'SN'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'kategori',
                                'displayName' => 'Kategori'
                                ])
                                <th>Harga</th>
                                <th>Keterangan</th>
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'status',
                                'displayName' => 'Status'
                                ])
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $number = ($barangs->currentPage() - 1) * $barangs->perPage();
                            @endphp
                            @forelse ($barangs as $barang)
                            <tr class="text-sm">
                                <td class="text-center">{{ ++$number }}</td>
                                <td class="text-center">{{ $barang->kode_barang }}</td>
                                <td class="text-center">{{ $barang->pemakai->nama }}</td>
                                <td class="text-center">{{ $barang->nama_barang }}</td>
                                <td class="text-center">{{ $barang->serial_number }}</td>
                                <td class="text-center">{{ $barang->kategori }}</td>
                                <td class="text-center">@currency($barang->harga)</td>
                                <td>{!! $barang->keterangan !!}</td>
                                <td class="text-center">
                                    @if ($barang->status == 'aktif')
                                    <span class="badge bg-success">{{ $barang->status }}</span>
                                    @elseif ($barang->status == 'tidak_aktif')
                                    <span class="badge bg-danger">{{ Str::camel($barang->status) }}</span>
                                    @elseif ($barang->status == 'sedang_service')
                                    <span class="badge bg-warning">{{ Str::camel($barang->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('barang.edit', $barang->id) }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('barang.destroy', $barang->id) }}" method="post"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $barangs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
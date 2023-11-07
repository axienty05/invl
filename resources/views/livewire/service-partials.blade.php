<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">{{ $title }}</h5>
            <div class="card-body">
                <a href="{{ route('service.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                <div class="row">
                    <div class="col-sm-2 mb-2">
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-filter-alt"></i></span>
                            <select id="inputState" class="form-select">
                                <option selected>All</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
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
                <div class="alert alert-primary alert-dismissible mt-3 mb-0" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover mt-3 mb-3">
                        <thead class="table">
                            <tr>
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'tgl_service',
                                'displayName' => 'Mulai'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'tgl_selesai',
                                'displayName' => 'Selesai'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'm_barang_id',
                                'displayName' => 'Barang'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'm_barang_id',
                                'displayName' => 'SN'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'no_sj',
                                'displayName' => 'SJ'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'm_pemakai_id',
                                'displayName' => 'Pemakai'
                                ])
                                <th class="align-middle">Biaya</th>
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'm_service_center_id',
                                'displayName' => 'Tempat'
                                ])
                                <th class="align-middle">Kerusakan</th>
                                <th class="align-middle">Analisa</th>
                                <th class="align-middle">Solusi</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                            <tr>
                                <td>{{ $service->tgl_service->format('d-M-Y') }}</td>
                                <td>{{ optional($service->tgl_selesai)->format('d-M-Y') }}</td>
                                <td>{{ $service->barang->nama_barang }}</td>
                                <td>{{ $service->barang->serial_number }}</td>
                                <td>{{ $service->no_sj }}</td>
                                <td>{{ $service->pemakai->nama }}</td>
                                <td>@currency($service->biaya)</td>
                                <td>{{ $service->servicecenter->nama_service }}</td>

                                <td>{{ substr($service->kerusakan, 0, 20) }}</td>
                                <td>{!! substr($service->analisa, 0, 20) !!}</td>
                                <td>{!! substr($service->solusi, 0, 20) !!}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('service.edit', $service->id) }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    {{-- <a class="btn btn-info btn-sm"
                                        href="{{ route('service.show', $service->id) }}"><i class="bx bx-show-alt"></i>
                                    </a> --}}
                                    <form action="{{ route('service.destroy', $service->id) }}" method="post"
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
                                <td colspan="13">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">{{ $title }}</h4>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col mb-3">
                        <a href="{{ route('pemakai.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    </div>
                    <div class="col-sm-3">
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
                <div class="table-responsive text-nowrap rounded-2">
                    <table class="table table-striped table-hover mt-3 mb-3">
                        <thead class="table text-light">
                            <tr>
                                <th>
                                    No
                                </th>
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'nama',
                                'displayName' => 'Nama'
                                ])
                                @include('livewire.includes.table-sortable-th', [
                                'name' => 'department',
                                'displayName' => 'Department'
                                ])
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $number = ($pemakais->currentPage() - 1) * $pemakais->perPage();
                            @endphp
                            @forelse ($pemakais as $pemakai)
                            <tr>
                                <td>{{ ++$number }}</td>
                                <td>{{ $pemakai->nama }}</td>
                                <td>{{ $pemakai->department }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="{{ route('pemakai.edit', $pemakai->id) }}">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('pemakai.destroy', $pemakai->id) }}" method="post"
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
                                <td colspan="4">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-4 px-3">
                        {{ $pemakais->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
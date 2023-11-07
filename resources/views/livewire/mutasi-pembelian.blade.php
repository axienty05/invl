<div class="card">
    <div class="card-header">
        Detail Mutasi
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">Barang</th>
                    <th>Pemakai</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dtMutasis as $index => $dtMutasi)
                <tr>
                    <td>
                        <select name="dtMutasis[{{ $index }}][m_barang_id]"
                            wire:model="dtMutasis.{{ $index }}.m_barang_id"
                            wire:change="updatePemakaiLama({{ $index }})" class="form-select">
                            <option value="" disabled>Pilih Barang</option>
                            @foreach($barangs as $barang)
                            @if (old('dtMutasis.{{ $index }}.m_barang_id') == $barang->id)
                            <option value="{{ $barang->id }}" selected>{{ $barang->nama_barang }}
                                s/n : {{ $barang->serial_number }}</option>
                            @else
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }} s/n : {{
                                $barang->serial_number }}</option>
                            @endif
                            @endforeach
                        </select>
                        <div>
                            @error('dtMutasis[{{ $index }}][m_barang_id]')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#basicModal">
                            +
                        </button>
                    </td>
                    <td>
                        <select class="form-control" name="dtMutasis[{{ $index }}][pemakai_lama]"
                            wire:model="dtMutasis.{{ $index }}.pemakai_lama" aria-label="Default select example">
                            @if($dtMutasis[$index]['m_barang_id'])
                            <option value="{{ $this->getPemakaiLama($dtMutasis[$index]['m_barang_id']) }}">
                                {{
                                $this->getPemakaiName($this->getPemakaiLama($dtMutasis[$index]['m_barang_id']))
                                }}</option>
                            @endif
                        </select>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number"
                                class="form-control @error('dtMutasis.'.$index.'.harga') is-invalid @enderror"
                                name="dtMutasis[{{ $index }}][harga]" min="0" wire:model="dtMutasis.{{ $index }}.harga">
                        </div>
                        @error('dtMutasis.'.$index.'.harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeDetail({{ $index }})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button wire:click.prevent="addDetail" class="btn btn-primary btn-sm mt-3">+ Tambah
                    Mutasi</button>
            </div>
        </div>
    </div>
</div>
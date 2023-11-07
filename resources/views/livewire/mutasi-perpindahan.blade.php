<div class="justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detail Mutasi
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Pemakai Lama</th>
                            <th>Pemakai Baru</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dtMutasis as $index => $dtMutasi)
                        <tr>
                            <td>
                                <select name="dtMutasis[{{ $index }}][m_barang_id]"
                                    wire:model="dtMutasis.{{ $index }}.m_barang_id"
                                    wire:change="updatePemakaiLama({{ $index }})" class="form-control">
                                    <option value="" disabled>Pilih Barang</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }} s/n :
                                        {{ $barang->serial_number }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="dtMutasis[{{ $index }}][pemakai_lama]"
                                    wire:model="dtMutasis.{{ $index }}.pemakai_lama" class="form-control">
                                    @if($dtMutasis[$index]['m_barang_id'])
                                    <option value="{{ $this->getPemakaiLama($dtMutasis[$index]['m_barang_id']) }}">
                                        {{
                                        $this->getPemakaiName($this->getPemakaiLama($dtMutasis[$index]['m_barang_id']))
                                        }}</option>
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select name="dtMutasis[{{ $index }}][pemakai_baru]"
                                    wire:model="dtMutasis.{{ $index }}.pemakai_baru" class="form-control">
                                    <option value="">Pemakai Baru</option>
                                    @foreach ($pemakaiBaru as $baru)
                                    <option value="{{ $baru->id }}">{{ $baru->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="dtMutasis[{{ $index }}][harga]" class="form-control"
                                    wire:model="dtMutasis.{{ $index }}.harga" readonly>
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
                        <button wire:click.prevent="addDetail" class="btn btn-primary btn-sm mt-3">+
                            Tambah Mutasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

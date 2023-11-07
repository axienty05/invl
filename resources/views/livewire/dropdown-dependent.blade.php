<div>
    <div class="form-group mb-3">
        <label for="m_pemakai_id" class="form-label">Nama pemakai</label>
        <select wire:model.live="selectedpemakai" class="form-select @error('m_pemakai_id') is-invalid @enderror"
            name="m_pemakai_id">
            <option value="" selected disabled>Pilih pemakai</option>
            @foreach ($pemakais as $pemakai)
            @if(old('m_pemakai_id') == $pemakai->id)
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

    @if(!is_null($selectedpemakai))
    <div class="form-group mb-3">
        <label for="m_barang_id" class="form-label">Barang</label>
        <select wire:model="selectedbarang" class="form-control @error('m_barang_id') is-invalid @enderror"
            name="m_barang_id" value={{ old('m_barang_id')}}>
            <option value="" disabled>Pilih barang</option>
            @foreach ($barangs as $barang)
            <option value="{{ $barang->id }}" selected>{{ $barang->nama_barang }} s/n : {{ $barang->serial_number }}
            </option>
            @endforeach
        </select>
        @error('m_barang_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif
</div>

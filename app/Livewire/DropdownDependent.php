<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\Pemakai;
use Livewire\Component;

class DropdownDependent extends Component
{
    public $pemakais;
    public $barangs;
    public $selectedpemakai = null;

    public function mount()
    {
        $this->pemakais = Pemakai::all();
        $this->selectedpemakai;
    }

    public function render()
    {
        return view('livewire.dropdown-dependent');
    }

    public function updatedSelectedpemakai()
    {
        // dd($this->selectedpemakai);
        $this->barangs = Barang::where('m_pemakai_id', $this->selectedpemakai)->get();
    }
}

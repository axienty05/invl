<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\Pemakai;
use Livewire\Attributes\Rule;
use Livewire\Component;

class MutasiPembelian extends Component
{
    #[Rule('required')]
    public $barangs = [];

    #[Rule('required')]
    public $dtMutasis = [];

    #[Rule('required')]
    public $pemakai = [];

    public function mount()
    {
        $this->barangs = Barang::all();
        $this->pemakai = Pemakai::all();
        $this->dtMutasis = [
            [
                'm_barang_id' => '',
                'pemakai_lama' => '',
                'pemakai_baru' => '',
                'harga' => 0,
            ]
        ];
    }

    public function addDetail()
    {
        $this->dtMutasis[] = [
            "m_barang_id" => '',
            "pemakai_lama" => '',
            'pemakai_baru' => '',
            "harga" => 0
        ];
    }

    public function getPemakaiLama($m_barang_id)
    {
        $barang = Barang::find($m_barang_id);
        if ($barang) {
            $m_pemakai_id = $barang->m_pemakai_id;
            $pemakai = Pemakai::find($m_pemakai_id);
            if ($pemakai) {
                return $pemakai->id;
            }
        }
        return '';
    }

    public function updatePemakaiLama($index)
    {
        $m_barang_id = $this->dtMutasis[$index]['m_barang_id'];
        $barang = Barang::find($m_barang_id);

        if ($barang) {
            $this->dtMutasis[$index]['pemakai_lama'] = $this->getPemakaiLama($m_barang_id);
        }
    }

    public function getPemakaiName($pemakai_id)
    {
        $pemakai = Pemakai::find($pemakai_id);
        return $pemakai ? $pemakai->nama : '';
    }


    public function removeDetail($index)
    {
        unset($this->dtMutasis[$index]);
        $this->dtMutasis = array_values($this->dtMutasis);
    }

    public function render()
    {
        return view('livewire.mutasi-pembelian');
    }
}

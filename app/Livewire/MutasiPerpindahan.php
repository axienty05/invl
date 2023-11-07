<?php

namespace App\Livewire;

use App\Models\Barang;
use App\Models\Pemakai;
use Livewire\Component;

class MutasiPerpindahan extends Component
{
    public $dtMutasis = [];
    public $barangs = [];
    public $pemakaiLama = [];
    public $pemakaiBaru = [];

    public function mount()
    {
        $this->barangs =  Barang::all();
        $this->pemakaiLama = Pemakai::all();
        $this->pemakaiBaru = Pemakai::all();
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
        $mbarang = Barang::find($m_barang_id);
        if ($mbarang) {
            $m_pemakai_id = $mbarang->m_pemakai_id;
            $mpemakai = Pemakai::find($m_pemakai_id);
            if ($mpemakai) {
                return $mpemakai->id;
            }
        }
        return '';
    }

    public function updatePemakaiLama($index)
    {
        $m_barang_id = $this->dtMutasis[$index]['m_barang_id'];
        $m_barang = Barang::find($m_barang_id);

        if ($m_barang) {
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
        return view('livewire.mutasi-perpindahan');
    }
}
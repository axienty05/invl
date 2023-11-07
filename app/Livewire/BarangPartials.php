<?php

namespace App\Livewire;

use App\Models\Barang;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class BarangPartials extends Component
{
    use WithPagination;

    protected $paginationTheme = 'Bootstrap';

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'id';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        return view('livewire.barang-partials', [
            'title' => 'Data Barang',
            'barangs' => Barang::with('pemakai')->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(25)
        ]);
    }
}
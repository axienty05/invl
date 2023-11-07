<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Url;

class ServicePartials extends Component
{

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

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
        return view('livewire.service-partials', [
            'title' => 'Data Service',
            'services' => Service::with(['pemakai', 'barang', 'servicecenter'])
                ->search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate(25)
        ]);
    }
}
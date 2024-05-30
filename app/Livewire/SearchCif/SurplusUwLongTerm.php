<?php

namespace App\Livewire\SearchCif;

use Livewire\Component;

class SurplusUwLongTerm extends Component
{
    protected $service;
    public $params;

    public $dataset;
    public $dataTable;

    public function boot(SurplusUwLongTerm $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Search CIF(Surplus UW Long Term)');
    }
    public function render()
    {
        return view('livewire.search-cif.surplus-uw-long-term');
    }
}

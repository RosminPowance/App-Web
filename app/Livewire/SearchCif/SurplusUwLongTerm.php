<?php

namespace App\Livewire\SearchCif;

use App\Services\ConsolidatedSurplusUw\SurplusUw\LongTerm\LongTermService;
use Livewire\Component;

class SurplusUwLongTerm extends Component
{
    protected $service;
    public $params;

    public $filterPeriode = [];
    public $filterBusiness = [];
    public $filterCabang = [];
    public $filterClientName = [];
    public $filterNoCif = [];
    public $filterNoPolis = [];

    public $dataset;

    public function boot(LongTermService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Search CIF(Surplus UW Long Term)');

        $this->filterPeriode    = $this->service->getFilterPeriode();
        $this->filterBusiness    = $this->service->getFilterBusiness();
        $this->filterCabang    = $this->service->getFilterCabang();
        $this->filterClientName = $this->service->getFilterClientName();
        $this->filterNoPolis    = $this->service->getFilterNoPolis();
        $this->filterNoCif      = $this->service->getFilterNoCif();
    }
    public function render()
    {
        return view('livewire.search-cif.surplus-uw-long-term');
    }
}

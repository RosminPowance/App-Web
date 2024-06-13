<?php

namespace App\Livewire\SearchCif;

use App\Services\ConsolidatedSurplusUw\SurplusUw\Year\YearService;
use Livewire\Component;

class SurplusUwYear extends Component
{

    protected $service;

    public $filterProdDateTime;
    public $filterBusiness;
    public $filterCabang;
    public $filterClientName;
    public $filterNoPolis;
    public $filterNoCif;

    public function boot(YearService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Search CIF (Surplus UW Year)');

        $this->filterProdDateTime = $this->service->getFilterProdDateTime();
        $this->filterCabang       = $this->service->getFilterCabang();
        $this->filterBusiness     = $this->service->getFilterBusiness();
        $this->filterClientName   = $this->service->getFilterClientName();
        $this->filterNoPolis      = $this->service->getFilterNoPolis();
        $this->filterNoCif        = $this->service->getFilterNoCif();
    }

    public function render()
    {
        return view('livewire.search-cif.surplus-uw-year');
    }
}

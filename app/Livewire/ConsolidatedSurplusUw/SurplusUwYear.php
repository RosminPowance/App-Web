<?php

namespace App\Livewire\ConsolidatedSurplusUw;

use App\Services\ConsolidatedSurplusUw\SurplusUw\Year\YearService;
use Livewire\Attributes\On;
use Livewire\Component;

class SurplusUwYear extends Component
{
    protected $service;

    public $params;

    public $dataset;
    public $dataTable;

    public function boot(YearService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Consolidated Surplus UW Year');
    }

    public function render()
    {
        return view('livewire.consolidated-surplus-uw.surplus-uw-long-term');
    }
}


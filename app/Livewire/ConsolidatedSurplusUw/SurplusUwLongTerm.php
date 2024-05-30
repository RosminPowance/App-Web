<?php

namespace App\Livewire\ConsolidatedSurplusUw;

use App\Services\ConsolidatedSurplusUw\SurplusUw\LongTerm\LongTermService;
use Livewire\Attributes\On;
use Livewire\Component;

class SurplusUwLongTerm extends Component
{
    protected $service;

    public $params;

    public $dataset;
    public $dataTable;

    public function boot(LongTermService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Consolidated Surplus UW Long Term');
    }
    public function render()
    {
        return view('livewire.consolidated-surplus-uw.surplus-uw-long-term');
    }


}


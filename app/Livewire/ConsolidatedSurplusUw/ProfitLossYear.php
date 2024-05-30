<?php

namespace App\Livewire\ConsolidatedSurplusUw;

use App\Services\ConsolidatedSurplusUw\ProfitLoss\Year\YearService;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfitLossYear extends Component
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
        \setPageTitle('Consolidated Profit/Loss Year');
    }

    public function render()
    {
        return view('livewire.consolidated-surplus-uw.profit-loss-year');
    }
}


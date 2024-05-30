<?php

namespace App\Livewire\ConsolidatedSurplusUw;

use App\Services\ConsolidatedSurplusUw\ProfitLoss\LongTerm\LongTermService;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfitLossLongTerm extends Component
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
        \setPageTitle('Consolidated Profit/Loss Long Term');
    }

    public function render()
    {
        return view('livewire.consolidated-surplus-uw.profit-loss-long-term');
    }
}

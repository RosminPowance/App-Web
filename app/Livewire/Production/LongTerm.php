<?php

namespace App\Livewire\Production;

use App\Services\Production\LongTerm\LongTermService;
use Livewire\Attributes\On;
use Livewire\Component;

class LongTerm extends Component
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
        \setPageTitle('Production Long Term');
    }

    public function render()
    {
        return view('livewire.production.long-term');
    }
}

<?php

namespace App\Livewire\Production;

use App\Services\Production\Year\YearService;
use Livewire\Attributes\On;
use Livewire\Component;

class Year extends Component
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
        \setPageTitle('Production Year');
    }

    public function render()
    {
        return view('livewire.production.year');
    }
}

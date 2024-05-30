<?php

namespace App\Livewire\Claim;

use App\Services\Claim\OutstandingClaim\OutstandingClaimService;
use Livewire\Attributes\On;
use Livewire\Component;

class OutstandingClaim extends Component
{
    protected $service;

    public $params;

    public $dataset;
    public $dataTable;

    public function boot(OutstandingClaimService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Outstanding Claim');
    }

    public function render()
    {
        return view('livewire.claim.outstanding-claim');

    }
}


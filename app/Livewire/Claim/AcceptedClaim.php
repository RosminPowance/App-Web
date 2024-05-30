<?php

namespace App\Livewire\Claim;

use App\Services\Claim\AcceptedClaim\AcceptedClaimService;
use Livewire\Attributes\On;
use Livewire\Component;

class AcceptedClaim extends Component
{

    protected $service;

    public $params;

    public $dataset;
    public $dataTable;

    public function boot(AcceptedClaimService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Accepted Claim');
    }
    
    public function render()
    {
        return view('livewire.claim.accepted-claim');
    }
}

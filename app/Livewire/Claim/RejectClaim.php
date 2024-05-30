<?php

namespace App\Livewire\Claim;

use App\Services\Claim\RejectClaim\RejectClaimService;
use Livewire\Attributes\On;
use Livewire\Component;

class RejectClaim extends Component
{
    protected $service;

    public $params;

    public $dataset;
    public $dataTable;

    public function boot(RejectClaimService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        \setPageTitle('Reject Claim');
    }

    public function render()
    {
        return view('livewire.claim.reject-claim');
    }
}

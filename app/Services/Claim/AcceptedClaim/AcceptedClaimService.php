<?php

namespace App\Services\Claim\AcceptedClaim;

use LaravelEasyRepository\BaseService;

interface AcceptedClaimService extends BaseService{

    public function getDataset();
    
}

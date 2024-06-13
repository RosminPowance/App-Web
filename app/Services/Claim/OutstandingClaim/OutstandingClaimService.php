<?php

namespace App\Services\Claim\OutstandingClaim;

use LaravelEasyRepository\BaseService;

interface OutstandingClaimService extends BaseService{

   
    public function getDataset($query = null);
    
}

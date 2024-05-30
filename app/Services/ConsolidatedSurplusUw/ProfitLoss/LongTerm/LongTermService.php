<?php

namespace App\Services\ConsolidatedSurplusUw\ProfitLoss\LongTerm;

use LaravelEasyRepository\BaseService;

interface LongTermService extends BaseService
{

    public function getDataset();
}



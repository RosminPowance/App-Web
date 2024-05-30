<?php

namespace App\Services\ConsolidatedSurplusUw\ProfitLoss\Year;

use LaravelEasyRepository\BaseService;

interface YearService extends BaseService{

    public function getDataset($query = null);
}


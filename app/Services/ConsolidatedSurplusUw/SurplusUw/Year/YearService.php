<?php

namespace App\Services\ConsolidatedSurplusUw\SurplusUw\Year;

use LaravelEasyRepository\BaseService;

interface YearService extends BaseService
{

    public function getDataset($query = []);
}


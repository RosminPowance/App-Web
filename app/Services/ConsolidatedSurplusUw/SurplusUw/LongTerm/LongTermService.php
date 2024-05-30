<?php

namespace App\Services\ConsolidatedSurplusUw\SurplusUw\LongTerm;

use LaravelEasyRepository\BaseService;

interface LongTermService extends BaseService
{
    public function getDataset($query = []);
}


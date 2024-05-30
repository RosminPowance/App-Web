<?php

namespace App\Services\SearchCif;

use LaravelEasyRepository\BaseService;

interface SurplusUwLongTermService extends BaseService{

    public function getDataset($query = null);
}

<?php

namespace App\Services\Production\Year;

use LaravelEasyRepository\BaseService;

interface YearService extends BaseService{

    public function getDataset($query = null);
}

<?php

namespace App\Services\Production\LongTerm;

use LaravelEasyRepository\BaseService;

interface LongTermService extends BaseService{

    public function getDataset();
}

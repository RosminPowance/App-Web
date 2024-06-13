<?php

namespace App\Services\ConsolidatedSurplusUw\SurplusUw\Year;

use LaravelEasyRepository\BaseService;

interface YearService extends BaseService
{

    public function getDataset($query = []);
    public function getFilterProdDateTime($query = []);
    public function getFilterBusiness($query = []);
    public function getFilterCabang($query = []);
    public function getFilterClientName($query = []);
    public function getFilterNoCif($query = []);
    public function getFilterNoPolis($query = []);
}


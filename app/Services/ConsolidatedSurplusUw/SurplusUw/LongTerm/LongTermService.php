<?php

namespace App\Services\ConsolidatedSurplusUw\SurplusUw\LongTerm;

use LaravelEasyRepository\BaseService;

interface LongTermService extends BaseService
{
    public function getDataset($query = []);
    public function getFilterPeriode($query = []);
    public function getFilterBusiness($query = []);
    public function getFilterCabang($query = []);
    public function getFilterClientName($query = []);
    public function getFilterNoCif($query = []);
    public function getFilterNoPolis($query = []);
}


<?php

namespace App\Repositories\LstUserAsuransi;

use LaravelEasyRepository\Repository;

interface LstUserAsuransiRepository extends Repository{

    public function findByNikAndPassId($nik, $passId);
}

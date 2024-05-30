<?php

namespace App\Services\SearchCif;

use LaravelEasyRepository\Service;
use App\Repositories\SearchCifSurplusUwYear\SurplusUwYearRepository;

class SearchCifSurplusUwYearServiceImplement extends Service implements SurplusUwYearService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SurplusUwYearRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}

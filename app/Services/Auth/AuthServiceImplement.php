<?php

namespace App\Services\Auth;

use App\Models\LstUserAsuransi;
use LaravelEasyRepository\Service;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\LstUserAsuransi\LstUserAsuransiRepository;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component as Livewire;

class AuthServiceImplement extends Service implements AuthService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(LstUserAsuransiRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function login($nik, $passId)
  {
    $user = $this->mainRepository->findByNikAndPassId($nik, $passId);
    if (!$user) {
      return false;
    }

    if (!Auth::loginUsingId($user->USER_ID)) {
      return false;
    }

    return true;
  }
}

<?php

namespace App\Repositories\Menu;

use Closure;
use LaravelEasyRepository\Repository;

interface MenuRepository extends Repository
{
    public function allWithClosure(?Closure $closure);
}

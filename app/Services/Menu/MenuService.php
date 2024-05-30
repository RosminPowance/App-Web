<?php

namespace App\Services\Menu;

use LaravelEasyRepository\BaseService;

interface MenuService extends BaseService{

    public function generate();
}

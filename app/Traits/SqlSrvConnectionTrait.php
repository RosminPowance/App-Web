<?php

namespace App\Trait;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait SqlSrvConnectionTrait
{

    function connect()
    {
        DB::disconnect();
        Config::set('database.default', 'sqlsrv');
        DB::reconnect();
        DB::purge('oracle');
    }
}

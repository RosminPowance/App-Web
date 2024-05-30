<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait ConnectionTrait
{

    function connect($driver)
    {
        $connections = [
            'sqlsrv' => 'sqlsrv',
            'oracle' => 'oracle',
        ];

        if (!isset($connections[$driver])) {
            throw new \Exception('Database driver not found');
        }

        DB::disconnect();
        Config::set('database.default', $driver);
        DB::reconnect();
        DB::purge();
    }
}

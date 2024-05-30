<?php

namespace App\Repositories\Production;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class ProductionRepositoryImplement extends Eloquent implements ProductionRepository
{
    
    public function getLongTerm()
    {
       return DB::select('EXEC SP_DETAIL_PRODUCTION_LONGTERM @sort = ?, @order = ?,  @current_page = ?, @page_size = ?,   @command = ?', ["''", "''", "''","''", "''"]);

    }
}

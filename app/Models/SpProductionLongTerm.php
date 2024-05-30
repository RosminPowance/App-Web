<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpProductionLongTerm extends Model
{
	protected $table = 'sp_production_long_term';

	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'TSI',
	];
}

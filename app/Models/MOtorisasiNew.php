<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MOtorisasiNew
 * 
 * @property string|null $user_id
 * @property float|null $app_id
 * @property float|null $menu_id
 * @property Carbon|null $rep_iu
 * @property string|null $rep_sts
 *
 * @package App\Models
 */
class MOtorisasiNew extends Model
{
	protected $table = 'm_otorisasi_new';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'float',
		'menu_id' => 'float',
		'rep_iu' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'app_id',
		'menu_id',
		'rep_iu',
		'rep_sts'
	];
}

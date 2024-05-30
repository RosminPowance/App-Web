<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MAplikasiNew
 * 
 * @property float|null $app_id
 * @property string|null $app_desc
 * @property string|null $sts_aktif
 * @property string|null $last_version
 * @property Carbon|null $rep_iu
 * @property string|null $rep_sts
 *
 * @package App\Models
 */
class MAplikasiNew extends Model
{
	protected $table = 'm_aplikasi_new';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'float',
		'rep_iu' => 'datetime'
	];

	protected $fillable = [
		'app_id',
		'app_desc',
		'sts_aktif',
		'last_version',
		'rep_iu',
		'rep_sts'
	];
}

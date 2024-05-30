<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Biayaoperasional
 * 
 * @property Carbon|null $lastrefresh
 * @property string|null $prodkey
 * @property string|null $tahun
 * @property string|null $ldc_id
 * @property string|null $account_no
 * @property string|null $description
 * @property float|null $biayaoperasional
 * @property string|null $source_data
 *
 * @package App\Models
 */
class Biayaoperasional extends Model
{
	protected $table = 'biayaoperasional';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'biayaoperasional' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'prodkey',
		'tahun',
		'ldc_id',
		'account_no',
		'description',
		'biayaoperasional',
		'source_data'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HasilInvestasi
 * 
 * @property Carbon $lastrefresh
 * @property string|null $prodkey
 * @property string|null $tahun
 * @property string|null $ldc_id
 * @property string|null $account_no
 * @property string|null $description
 * @property float|null $investasi
 * @property string|null $source_data
 *
 * @package App\Models
 */
class HasilInvestasi extends Model
{
	protected $table = 'hasil_investasi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'investasi' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'prodkey',
		'tahun',
		'ldc_id',
		'account_no',
		'description',
		'investasi',
		'source_data'
	];
}

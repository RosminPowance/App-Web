<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HasiNonOperasional
 * 
 * @property Carbon|null $lastrefresh
 * @property string|null $prodkey
 * @property string|null $tahun
 * @property string|null $ldc_id
 * @property string|null $account_no
 * @property string|null $description
 * @property float|null $biayanonoperasional
 * @property string|null $source_data
 *
 * @package App\Models
 */
class HasiNonOperasional extends Model
{
	protected $table = 'hasi_non_operasional';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'biayanonoperasional' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'prodkey',
		'tahun',
		'ldc_id',
		'account_no',
		'description',
		'biayanonoperasional',
		'source_data'
	];
}

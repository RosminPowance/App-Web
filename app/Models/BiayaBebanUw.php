<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BiayaBebanUw
 * 
 * @property Carbon $lastrefresh
 * @property string|null $prodkey
 * @property string|null $tahun
 * @property string|null $ldc_id
 * @property string|null $account_no
 * @property string|null $description
 * @property float|null $beban_uw
 * @property string|null $lag_agen_id
 * @property string|null $msp_jn_paket
 * @property string|null $nama_ceding
 * @property string|null $mds_jn_coas
 * @property string|null $source_data
 *
 * @package App\Models
 */
class BiayaBebanUw extends Model
{
	protected $table = 'biaya_beban_uw';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'beban_uw' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'prodkey',
		'tahun',
		'ldc_id',
		'account_no',
		'description',
		'beban_uw',
		'lag_agen_id',
		'msp_jn_paket',
		'nama_ceding',
		'mds_jn_coas',
		'source_data'
	];
}

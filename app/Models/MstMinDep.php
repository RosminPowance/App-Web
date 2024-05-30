<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MstMinDep
 * 
 * @property string|null $tahun_treaty
 * @property string|null $top_id
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_agen_id
 * @property float|null $mindep
 * @property string|null $bulan
 * @property string|null $msp_jn_paket
 * @property string|null $nama_ceding
 * @property string|null $mds_jn_coas
 *
 * @package App\Models
 */
class MstMinDep extends Model
{
	protected $table = 'mst_min_dep';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'mindep' => 'float'
	];

	protected $fillable = [
		'tahun_treaty',
		'top_id',
		'ldc_id',
		'lbu_id',
		'lag_agen_id',
		'mindep',
		'bulan',
		'msp_jn_paket',
		'nama_ceding',
		'mds_jn_coas'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstJenisCoa
 * 
 * @property string|null $mds_jn_coas
 * @property string|null $keterangan
 *
 * @package App\Models
 */
class LstJenisCoa extends Model
{
	protected $table = 'lst_jenis_coas';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'mds_jn_coas',
		'keterangan'
	];
}

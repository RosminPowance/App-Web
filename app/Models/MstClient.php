<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MstClient
 * 
 * @property string|null $mcl_id
 * @property string|null $mcl_name
 * @property Carbon|null $mcl_tgl_input
 * @property string|null $mcl_jenis
 * @property string|null $bidang_usaha
 *
 * @package App\Models
 */
class MstClient extends Model
{
	protected $table = 'mst_client';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'mcl_tgl_input' => 'datetime'
	];

	protected $fillable = [
		'mcl_id',
		'mcl_name',
		'mcl_tgl_input',
		'mcl_jenis',
		'bidang_usaha'
	];
}

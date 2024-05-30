<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstDetCabang
 * 
 * @property string|null $ldc_id
 * @property int $YEAR
 * @property string|null $kelas_cabang
 *
 * @package App\Models
 */
class LstDetCabang extends Model
{
	protected $table = 'lst_det_cabang';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'YEAR' => 'int'
	];

	protected $fillable = [
		'ldc_id',
		'YEAR',
		'kelas_cabang'
	];
}

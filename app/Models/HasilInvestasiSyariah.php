<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HasilInvestasiSyariah
 * 
 * @property Carbon|null $lastrefresh
 * @property int|null $tahun
 * @property string|null $ldc_id
 * @property string|null $account_no
 * @property string|null $description
 * @property float|null $investasi
 * @property string|null $thnbln
 * @property string|null $Type
 * @property string|null $lbu_id
 *
 * @package App\Models
 */
class HasilInvestasiSyariah extends Model
{
	protected $table = 'hasil_investasi_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'tahun' => 'int',
		'investasi' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'tahun',
		'ldc_id',
		'account_no',
		'description',
		'investasi',
		'thnbln',
		'Type',
		'lbu_id'
	];
}

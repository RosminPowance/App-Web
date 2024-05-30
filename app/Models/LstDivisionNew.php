<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LstDivisionNew
 * 
 * @property string|null $ldi_id
 * @property string|null $mcl_id
 * @property string|null $lde_id
 * @property string|null $ldi_divisi
 * @property Carbon|null $rep_iu
 * @property string|null $rep_sts
 *
 * @package App\Models
 */
class LstDivisionNew extends Model
{
	protected $table = 'lst_division_new';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rep_iu' => 'datetime'
	];

	protected $fillable = [
		'ldi_id',
		'mcl_id',
		'lde_id',
		'ldi_divisi',
		'rep_iu',
		'rep_sts'
	];
}

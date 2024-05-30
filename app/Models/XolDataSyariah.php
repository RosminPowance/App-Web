<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class XolDataSyariah
 * 
 * @property string|null $no_polis
 * @property float|null $xl
 * @property string|null $tipe
 * @property string|null $thnbln
 *
 * @package App\Models
 */
class XolDataSyariah extends Model
{
	protected $table = 'xol_data_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'xl' => 'float'
	];

	protected $fillable = [
		'no_polis',
		'xl',
		'tipe',
		'thnbln'
	];
}
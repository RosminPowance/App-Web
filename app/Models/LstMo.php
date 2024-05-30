<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstMo
 * 
 * @property string|null $lmo_id
 * @property string|null $lmo_leader
 * @property string|null $nm_mo
 *
 * @package App\Models
 */
class LstMo extends Model
{
	protected $table = 'lst_mo';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'lmo_id',
		'lmo_leader',
		'nm_mo'
	];
}

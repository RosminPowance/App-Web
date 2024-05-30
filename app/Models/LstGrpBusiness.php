<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstGrpBusiness
 * 
 * @property string|null $lgb_id
 * @property string|null $lgb_note
 * @property string|null $top_id
 * @property int $urut
 *
 * @package App\Models
 */
class LstGrpBusiness extends Model
{
	protected $table = 'lst_grp_business';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'urut' => 'int'
	];

	protected $fillable = [
		'lgb_id',
		'lgb_note',
		'top_id',
		'urut'
	];
}

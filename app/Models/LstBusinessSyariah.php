<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstBusinessSyariah
 * 
 * @property string|null $lbu_id
 * @property string|null $lgb_id
 * @property string|null $lbu_note
 * @property string|null $type_note
 *
 * @package App\Models
 */
class LstBusinessSyariah extends Model
{
	protected $table = 'lst_business_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'lbu_id',
		'lgb_id',
		'lbu_note',
		'type_note'
	];
}

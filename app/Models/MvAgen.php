<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MvAgen
 * 
 * @property string|null $lag_agen_id
 * @property float|null $lvl
 * @property string|null $lag_leader
 * @property string|null $nama
 * @property string|null $leader0
 * @property string|null $leader1
 * @property string|null $leader2
 * @property string|null $leader3
 * @property string|null $leader4
 * @property string|null $leader5
 * @property string|null $namaleader0
 * @property string|null $namaleader1
 * @property string|null $namaleader2
 * @property string|null $namaleader3
 * @property string|null $namaleader4
 * @property string|null $namaleader5
 * @property string|null $leader3_pega
 *
 * @package App\Models
 */
class MvAgen extends Model
{
	protected $table = 'mv_agen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lvl' => 'float'
	];

	protected $fillable = [
		'lag_agen_id',
		'lvl',
		'lag_leader',
		'nama',
		'leader0',
		'leader1',
		'leader2',
		'leader3',
		'leader4',
		'leader5',
		'namaleader0',
		'namaleader1',
		'namaleader2',
		'namaleader3',
		'namaleader4',
		'namaleader5',
		'leader3_pega'
	];
}

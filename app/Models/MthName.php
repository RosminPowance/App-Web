<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mthname
 * 
 * @property string|null $mthname
 * @property int $mthkey
 * @property int $thn
 * @property int $bln
 * @property string|null $thnbln
 * @property string|null $tgl
 * @property int|null $thnblndesc
 *
 * @package App\Models
 */
class Mthname extends Model
{
	protected $table = 'mthname';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'mthkey' => 'int',
		'thn' => 'int',
		'bln' => 'int',
		'thnblndesc' => 'int'
	];

	protected $fillable = [
		'mthname',
		'mthkey',
		'thn',
		'bln',
		'thnbln',
		'tgl',
		'thnblndesc'
	];
}

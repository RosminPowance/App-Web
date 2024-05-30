<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proddatetime
 * 
 * @property string|null $proddatetime
 * @property string|null $proddatetime2
 * @property string|null $prodkey
 * @property int|null $thnblndesc
 *
 * @package App\Models
 */
class Proddatetime extends Model
{
	protected $table = 'proddatetime';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'thnblndesc' => 'int'
	];

	protected $fillable = [
		'proddatetime',
		'proddatetime2',
		'prodkey',
		'thnblndesc'
	];
}

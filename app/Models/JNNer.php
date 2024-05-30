<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jnner
 * 
 * @property string|null $jn_ner
 * @property string|null $description
 *
 * @package App\Models
 */
class Jnner extends Model
{
	protected $table = 'jnner';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'jn_ner',
		'description'
	];
}

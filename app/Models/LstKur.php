<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstKur
 * 
 * @property string|null $lku_id
 * @property string|null $lne_id
 * @property string|null $lku_simbol
 * @property string|null $cur
 * @property string|null $ket
 *
 * @package App\Models
 */
class LstKur extends Model
{
	protected $table = 'lst_kurs';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'lku_id',
		'lne_id',
		'lku_simbol',
		'cur',
		'ket'
	];
}

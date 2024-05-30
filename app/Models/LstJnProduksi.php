<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstJnProduksi
 * 
 * @property string|null $ljp_id
 * @property string|null $ljp_note
 * @property string|null $ljp_algorith
 *
 * @package App\Models
 */
class LstJnProduksi extends Model
{
	protected $table = 'lst_jn_produksi';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'ljp_id',
		'ljp_note',
		'ljp_algorith'
	];
}

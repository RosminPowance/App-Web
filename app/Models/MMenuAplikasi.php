<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MMenuAplikasi
 * 
 * @property float|null $app_id
 * @property float|null $menu_id
 * @property string|null $menu_desc
 * @property string|null $menu_program
 * @property float|null $menu_id_leader
 * @property float|null $menu_sequence
 * @property float|null $app_id_leader
 * @property Carbon|null $rep_iu
 * @property string|null $rep_sts
 * @property string|null $menu_program1
 *
 * @package App\Models
 */
class MMenuAplikasi extends Model
{
	protected $table = 'm_menu_aplikasi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'app_id' => 'float',
		'menu_id' => 'float',
		'menu_id_leader' => 'float',
		'menu_sequence' => 'float',
		'app_id_leader' => 'float',
		'rep_iu' => 'datetime'
	];

	protected $fillable = [
		'app_id',
		'menu_id',
		'menu_desc',
		'menu_program',
		'menu_id_leader',
		'menu_sequence',
		'app_id_leader',
		'rep_iu',
		'rep_sts',
		'menu_program1'
	];

	public function children()
	{
		return $this->hasMany(self::class, 'MENU_ID_LEADER', 'MENU_ID');
	}
}

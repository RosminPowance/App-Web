<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LstRole
 * 
 * @property string|null $lus_id
 * @property string|null $seq
 * @property string|null $ket
 * @property string|null $ldc_id
 * @property string|null $ldc_id_2
 * @property string|null $nik
 * @property string|null $nama
 * @property string|null $ldc_id_var
 * @property int|null $val
 * @property int|null $sts_login_sementara
 * @property int|null $type_menu
 *
 * @package App\Models
 */
class LstRole extends Model
{
	protected $table = 'lst_roles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'val' => 'int',
		'sts_login_sementara' => 'int',
		'type_menu' => 'int'
	];

	protected $fillable = [
		'lus_id',
		'seq',
		'ket',
		'ldc_id',
		'ldc_id_2',
		'nik',
		'nama',
		'ldc_id_var',
		'val',
		'sts_login_sementara',
		'type_menu'
	];
}

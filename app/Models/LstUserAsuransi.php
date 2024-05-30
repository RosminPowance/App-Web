<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * Class LstUserAsuransi
 * 
 * @property string|null $lus_id
 * @property string|null $pt_id
 * @property string|null $cab_id
 * @property string|null $ldi_id
 * @property string|null $lde_id
 * @property string|null $user_id
 * @property string|null $pass_id
 * @property string|null $user_init
 * @property string|null $sts_aktif
 * @property string|null $ljb_id
 * @property string|null $inisial
 * @property string|null $rep_cab_id
 * @property string|null $sts_tekno
 * @property Carbon|null $rep_iu
 * @property string|null $rep_sts
 * @property string|null $nik
 * @property Carbon|null $tgl_awal
 * @property Carbon|null $tgl_akhir
 * @property float|null $max_umur_password
 * @property string|null $sts_svy_partial
 *
 * @package App\Models
 */
class LstUserAsuransi extends Authenticatable
{
	protected $table = 'lst_user_asuransi';
	protected $primaryKey = 'user_id';

	protected $rememberTokenName = 'remember_token';

	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rep_iu' => 'datetime',
		'tgl_awal' => 'datetime',
		'tgl_akhir' => 'datetime',
		'max_umur_password' => 'float'
	];

	protected $fillable = [
		'lus_id',
		'pt_id',
		'cab_id',
		'ldi_id',
		'lde_id',
		'user_id',
		'pass_id',
		'user_init',
		'sts_aktif',
		'ljb_id',
		'inisial',
		'rep_cab_id',
		'sts_tekno',
		'rep_iu',
		'rep_sts',
		'nik',
		'tgl_awal',
		'tgl_akhir',
		'max_umur_password',
		'sts_svy_partial'
	];

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifierName() 
	 */
	public function getAuthIdentifierName()
	{
		return "USER_ID";
	}

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifier() 
	 */
	public function getAuthIdentifier()
	{
		return $this->{$this->getAuthIdentifierName()};
	}

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthPassword() 
	 */
	public function getAuthPassword()
	{
		return $this->PASS_ID;
	}

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberToken() 
	 */
	public function getRememberToken()
	{
		if (!empty($this->getRememberTokenName())) {
			return $this->{$this->getRememberTokenName()};
		}
	}

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::setRememberToken() 
	 */
	public function setRememberToken($value)
	{
		if (!empty($this->getRememberTokenName())) {
			$this->{$this->getRememberTokenName()} = $value;
		}
	}

	/** 
	 * {@inheritDoc} 
	 * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberTokenName() 
	 */
	public function getRememberTokenName()
	{
		return $this->rememberTokenName;
	}
}

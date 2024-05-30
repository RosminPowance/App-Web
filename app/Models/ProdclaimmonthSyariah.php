<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProdclaimmonthSyariah
 * 
 * @property Carbon|null $lastrefresh
 * @property string|null $mthname
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_agen_id
 * @property string|null $no_polis
 * @property string|null $no_cif
 * @property float|null $gpw
 * @property float|null $disc
 * @property float|null $disc2
 * @property float|null $comm
 * @property float|null $oc
 * @property float|null $ngpw
 * @property float|null $ri
 * @property float|null $ricom
 * @property float|null $npw
 * @property float|null $premium_reserve
 * @property float|null $net_premium_earned
 * @property float|null $acceptedclaim
 * @property float|null $rejectclaim
 * @property float|null $outstandingclaim
 * @property float|null $reversedclaim
 * @property float|null $surplus_deficit_uw
 * @property string|null $lmo_id
 * @property string|null $client_id
 * @property string|null $partcol
 * @property float|null $cadpremi
 * @property float|null $cadpremi1
 * @property float|null $tsi
 * @property float|null $gpw_dana_tabaru
 * @property float|null $gpw_ujroh
 * @property float|null $ngpw_dana_tabaru
 * @property float|null $npw_dana_tabaru
 * @property float|null $premium_reserve_dana_tabaru
 * @property float|null $cadpremi_dana_tabaru
 * @property float|null $cadpremi1_dana_tabaru
 * @property float|null $net_premium_earned_dana_tabaru
 * @property float|null $surplus_deficit_uw_dana_tabaru
 * @property string|null $msp_jn_paket
 * @property float|null $kickback_komisi
 * @property float|null $kickback_incentive
 * @property string|null $mds_jn_coas
 * @property string|null $nama_ceding
 * @property string|null $flag_ors
 * @property float|null $ivd_ri_kom
 * @property float|null $ivd_hand_fee
 * @property string|null $nama_dealer
 * @property float|null $ppn
 *
 * @package App\Models
 */
class ProdclaimmonthSyariah extends Model
{
	protected $table = 'prodclaimmonth_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'gpw' => 'float',
		'disc' => 'float',
		'disc2' => 'float',
		'comm' => 'float',
		'oc' => 'float',
		'ngpw' => 'float',
		'ri' => 'float',
		'ricom' => 'float',
		'npw' => 'float',
		'premium_reserve' => 'float',
		'net_premium_earned' => 'float',
		'acceptedclaim' => 'float',
		'rejectclaim' => 'float',
		'outstandingclaim' => 'float',
		'reversedclaim' => 'float',
		'surplus_deficit_uw' => 'float',
		'cadpremi' => 'float',
		'cadpremi1' => 'float',
		'tsi' => 'float',
		'gpw_dana_tabaru' => 'float',
		'gpw_ujroh' => 'float',
		'ngpw_dana_tabaru' => 'float',
		'npw_dana_tabaru' => 'float',
		'premium_reserve_dana_tabaru' => 'float',
		'cadpremi_dana_tabaru' => 'float',
		'cadpremi1_dana_tabaru' => 'float',
		'net_premium_earned_dana_tabaru' => 'float',
		'surplus_deficit_uw_dana_tabaru' => 'float',
		'kickback_komisi' => 'float',
		'kickback_incentive' => 'float',
		'ivd_ri_kom' => 'float',
		'ivd_hand_fee' => 'float',
		'ppn' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'mthname',
		'ldc_id',
		'lbu_id',
		'lag_agen_id',
		'no_polis',
		'no_cif',
		'gpw',
		'disc',
		'disc2',
		'comm',
		'oc',
		'ngpw',
		'ri',
		'ricom',
		'npw',
		'premium_reserve',
		'net_premium_earned',
		'acceptedclaim',
		'rejectclaim',
		'outstandingclaim',
		'reversedclaim',
		'surplus_deficit_uw',
		'lmo_id',
		'client_id',
		'partcol',
		'cadpremi',
		'cadpremi1',
		'tsi',
		'gpw_dana_tabaru',
		'gpw_ujroh',
		'ngpw_dana_tabaru',
		'npw_dana_tabaru',
		'premium_reserve_dana_tabaru',
		'cadpremi_dana_tabaru',
		'cadpremi1_dana_tabaru',
		'net_premium_earned_dana_tabaru',
		'surplus_deficit_uw_dana_tabaru',
		'msp_jn_paket',
		'kickback_komisi',
		'kickback_incentive',
		'mds_jn_coas',
		'nama_ceding',
		'flag_ors',
		'ivd_ri_kom',
		'ivd_hand_fee',
		'nama_dealer',
		'ppn'
	];
}

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prodclaimuwmththn
 * 
 * @property Carbon|null $lastrefresh
 * @property string|null $prodkey
 * @property string|null $proddatetime
 * @property string|null $ner
 * @property string|null $client_id
 * @property string|null $no_cif
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_id
 * @property string|null $lmo_id
 * @property string|null $no_polis
 * @property float|null $tsi
 * @property float|null $gpw
 * @property float|null $disc
 * @property float|null $disc2
 * @property float|null $comm
 * @property float|null $comm_ri
 * @property float|null $oc
 * @property float|null $ngpw
 * @property float|null $ri
 * @property float|null $ricom
 * @property float|null $npw
 * @property float|null $cadpremi
 * @property float|null $cadpremi1
 * @property float|null $premium_reserve
 * @property float|null $net_premium_earned
 * @property float|null $acceptedclaim
 * @property float|null $rejectclaim
 * @property float|null $outstandingclaim
 * @property float|null $reversedclaim
 * @property float|null $xol
 * @property float|null $surplus_deficit_uw
 * @property float|null $totpolis
 * @property string|null $partcol
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
 * @property string|null $okupasi
 * @property string|null $flag_ors
 * @property float|null $ivd_ri_kom
 * @property float|null $ivd_hand_fee
 * @property string|null $nama_dealer
 * @property float|null $ppn
 *
 * @package App\Models
 */
class Prodclaimuwmththn extends Model
{
	protected $table = 'prodclaimuwmththn';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'tsi' => 'float',
		'gpw' => 'float',
		'disc' => 'float',
		'disc2' => 'float',
		'comm' => 'float',
		'comm_ri' => 'float',
		'oc' => 'float',
		'ngpw' => 'float',
		'ri' => 'float',
		'ricom' => 'float',
		'npw' => 'float',
		'cadpremi' => 'float',
		'cadpremi1' => 'float',
		'premium_reserve' => 'float',
		'net_premium_earned' => 'float',
		'acceptedclaim' => 'float',
		'rejectclaim' => 'float',
		'outstandingclaim' => 'float',
		'reversedclaim' => 'float',
		'xol' => 'float',
		'surplus_deficit_uw' => 'float',
		'totpolis' => 'float',
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
		'prodkey',
		'proddatetime',
		'ner',
		'client_id',
		'no_cif',
		'ldc_id',
		'lbu_id',
		'lag_id',
		'lmo_id',
		'no_polis',
		'tsi',
		'gpw',
		'disc',
		'disc2',
		'comm',
		'comm_ri',
		'oc',
		'ngpw',
		'ri',
		'ricom',
		'npw',
		'cadpremi',
		'cadpremi1',
		'premium_reserve',
		'net_premium_earned',
		'acceptedclaim',
		'rejectclaim',
		'outstandingclaim',
		'reversedclaim',
		'xol',
		'surplus_deficit_uw',
		'totpolis',
		'partcol',
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
		'okupasi',
		'flag_ors',
		'ivd_ri_kom',
		'ivd_hand_fee',
		'nama_dealer',
		'ppn'
	];
}

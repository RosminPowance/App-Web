<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Production
 * 
 * @property Carbon|null $lastrefresh
 * @property string|null $client_id
 * @property string|null $no_cif
 * @property string|null $lag_id
 * @property string|null $lmo_id
 * @property string|null $lbu_id
 * @property string|null $ldc_id
 * @property string|null $lku_id
 * @property string|null $ljp_id
 * @property string|null $jn_ner
 * @property string|null $no_spak
 * @property string|null $prod_ke
 * @property float|null $no_urut
 * @property string|null $no_polis
 * @property string|null $b_date_th
 * @property string|null $e_date_th
 * @property string|null $tgl_prod
 * @property float|null $co_share
 * @property float|null $plus_minus
 * @property float|null $tsi
 * @property float|null $premi
 * @property float|null $disc
 * @property float|null $disc2
 * @property float|null $comm
 * @property float|null $oc
 * @property float|null $bi_materai
 * @property float|null $bi_admin
 * @property float|null $reinsurance
 * @property float|null $ricom
 * @property float|null $exchange
 * @property string|null $partcol
 * @property int $totalpolis
 * @property float|null $persen_dana_tabaru
 * @property float|null $persen_ujroh
 * @property float|null $persen_syariah
 * @property string|null $msp_jn_paket
 * @property string|null $alasan
 * @property float|null $kickback_komisi
 * @property float|null $kickback_incentive
 * @property string|null $tgl_print
 * @property string|null $no_kontrak
 * @property string|null $mds_jn_coas
 * @property string|null $nama_ceding
 * @property float|null $ivd_ri_kom
 * @property float|null $ivd_hand_fee
 * @property string|null $nama_dealer
 * @property float|null $ppn
 * @property string|null $tgl_spread
 * @property string|null $flag_edit_reas
 *
 * @package App\Models
 */
class Production extends Model
{
	protected $table = 'production';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'no_urut' => 'float',
		'co_share' => 'float',
		'plus_minus' => 'float',
		'tsi' => 'float',
		'premi' => 'float',
		'disc' => 'float',
		'disc2' => 'float',
		'comm' => 'float',
		'oc' => 'float',
		'bi_materai' => 'float',
		'bi_admin' => 'float',
		'reinsurance' => 'float',
		'ricom' => 'float',
		'exchange' => 'float',
		'totalpolis' => 'int',
		'persen_dana_tabaru' => 'float',
		'persen_ujroh' => 'float',
		'persen_syariah' => 'float',
		'kickback_komisi' => 'float',
		'kickback_incentive' => 'float',
		'ivd_ri_kom' => 'float',
		'ivd_hand_fee' => 'float',
		'ppn' => 'float'
	];

	protected $fillable = [
		'lastrefresh',
		'client_id',
		'no_cif',
		'lag_id',
		'lmo_id',
		'lbu_id',
		'ldc_id',
		'lku_id',
		'ljp_id',
		'jn_ner',
		'no_spak',
		'prod_ke',
		'no_urut',
		'no_polis',
		'b_date_th',
		'e_date_th',
		'tgl_prod',
		'co_share',
		'plus_minus',
		'tsi',
		'premi',
		'disc',
		'disc2',
		'comm',
		'oc',
		'bi_materai',
		'bi_admin',
		'reinsurance',
		'ricom',
		'exchange',
		'partcol',
		'totalpolis',
		'persen_dana_tabaru',
		'persen_ujroh',
		'persen_syariah',
		'msp_jn_paket',
		'alasan',
		'kickback_komisi',
		'kickback_incentive',
		'tgl_print',
		'no_kontrak',
		'mds_jn_coas',
		'nama_ceding',
		'ivd_ri_kom',
		'ivd_hand_fee',
		'nama_dealer',
		'ppn',
		'tgl_spread',
		'flag_edit_reas'
	];
}

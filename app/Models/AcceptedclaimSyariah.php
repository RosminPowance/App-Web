<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AcceptedclaimSyariah
 * 
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_agen_id
 * @property string|null $accepted_no
 * @property string|null $no_polis
 * @property string|null $insured
 * @property string|null $no_cif
 * @property string|null $mo
 * @property string|null $workshop
 * @property string|null $prepare_date
 * @property string|null $date_of_loss
 * @property string|null $accepted_date
 * @property float|null $tsi_cumm
 * @property string|null $b_date
 * @property string|null $e_date
 * @property string|null $lku_id
 * @property float|null $accepted_claim
 * @property float|null $accepted_claim_rp
 * @property float|null $own_retention
 * @property float|null $co_ins
 * @property float|null $psrspl
 * @property float|null $qs_ri
 * @property float|null $er1
 * @property float|null $surplus1
 * @property float|null $surplus2
 * @property float|null $er2
 * @property float|null $psrqs_ri
 * @property float|null $psrqs_or
 * @property float|null $ors
 * @property float|null $facultative
 * @property float|null $facobl
 * @property float|null $bppdan
 * @property float|null $xl
 * @property float|null $pss
 * @property float|null $prgbi
 * @property string|null $client_id
 * @property string|null $partcol
 * @property string|null $msp_jn_paket
 * @property string|null $lmo_id
 * @property float|null $pfra
 * @property string|null $col_desc
 * @property string|null $risk_loc
 * @property string|null $nama_dealer
 *
 * @package App\Models
 */
class AcceptedclaimSyariah extends Model
{
	protected $table = 'acceptedclaim_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'tsi_cumm' => 'float',
		'accepted_claim' => 'float',
		'accepted_claim_rp' => 'float',
		'own_retention' => 'float',
		'co_ins' => 'float',
		'psrspl' => 'float',
		'qs_ri' => 'float',
		'er1' => 'float',
		'surplus1' => 'float',
		'surplus2' => 'float',
		'er2' => 'float',
		'psrqs_ri' => 'float',
		'psrqs_or' => 'float',
		'ors' => 'float',
		'facultative' => 'float',
		'facobl' => 'float',
		'bppdan' => 'float',
		'xl' => 'float',
		'pss' => 'float',
		'prgbi' => 'float',
		'pfra' => 'float'
	];

	protected $fillable = [
		'ldc_id',
		'lbu_id',
		'lag_agen_id',
		'accepted_no',
		'no_polis',
		'insured',
		'no_cif',
		'mo',
		'workshop',
		'prepare_date',
		'date_of_loss',
		'accepted_date',
		'tsi_cumm',
		'b_date',
		'e_date',
		'lku_id',
		'accepted_claim',
		'accepted_claim_rp',
		'own_retention',
		'co_ins',
		'psrspl',
		'qs_ri',
		'er1',
		'surplus1',
		'surplus2',
		'er2',
		'psrqs_ri',
		'psrqs_or',
		'ors',
		'facultative',
		'facobl',
		'bppdan',
		'xl',
		'pss',
		'prgbi',
		'client_id',
		'partcol',
		'msp_jn_paket',
		'lmo_id',
		'pfra',
		'col_desc',
		'risk_loc',
		'nama_dealer'
	];
}

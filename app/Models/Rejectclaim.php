<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rejectclaim
 * 
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_agen_id
 * @property string|null $accepted_no
 * @property string|null $no_polis
 * @property string|null $no_cif
 * @property string|null $insured
 * @property string|null $mo
 * @property string|null $prepare_date
 * @property string|null $date_of_loss
 * @property string|null $rejected_date
 * @property float|null $tsi_cumm
 * @property string|null $b_date
 * @property string|null $e_date
 * @property string|null $lku_id
 * @property float|null $reject_claim
 * @property float|null $reject_claim_rp
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
 * @property float|null $facoblig
 * @property float|null $bppdan
 * @property float|null $xl
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
class Rejectclaim extends Model
{
	protected $table = 'rejectclaim';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'tsi_cumm' => 'float',
		'reject_claim' => 'float',
		'reject_claim_rp' => 'float',
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
		'facoblig' => 'float',
		'bppdan' => 'float',
		'xl' => 'float',
		'pfra' => 'float'
	];

	protected $fillable = [
		'ldc_id',
		'lbu_id',
		'lag_agen_id',
		'accepted_no',
		'no_polis',
		'no_cif',
		'insured',
		'mo',
		'prepare_date',
		'date_of_loss',
		'rejected_date',
		'tsi_cumm',
		'b_date',
		'e_date',
		'lku_id',
		'reject_claim',
		'reject_claim_rp',
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
		'facoblig',
		'bppdan',
		'xl',
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

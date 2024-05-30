<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SurplusManual
 * 
 * @property string|null $id1
 * @property string|null $id2
 * @property Carbon|null $lastrefresh
 * @property string|null $proddatetime
 * @property string|null $ldc_id
 * @property string|null $lbu_id
 * @property string|null $lag_id
 * @property string|null $lmo_id
 * @property float|null $gpw
 * @property float|null $disc
 * @property float|null $disc2
 * @property float|null $comm
 * @property float|null $oc
 * @property float|null $ri
 * @property float|null $ricom
 * @property float|null $premium_reserve
 * @property float|null $acceptedclaim
 * @property float|null $rejectclaim
 * @property float|null $outstandingclaim
 * @property float|null $reversedclaim
 * @property string|null $notes
 * @property float|null $beban_uw
 * @property float|null $biayanonoperasional
 * @property float|null $biayaoperasional
 * @property float|null $investasi
 * @property float|null $bagi_hasil_peserta
 * @property string|null $prodkey
 * @property string|null $mthname
 * @property string|null $mthname2
 * @property string|null $partcol
 * @property float|null $cadpremi
 * @property float|null $cadpremi1
 * @property float|null $biaya_kantor_pusat
 * @property float|null $cadangan_dana_tabaru
 * @property float|null $zakat
 * @property string|null $tipe_surplus
 * @property string|null $upload_sistem
 *
 * @package App\Models
 */
class SurplusManual extends Model
{
	protected $table = 'surplus_manual';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'lastrefresh' => 'datetime',
		'gpw' => 'float',
		'disc' => 'float',
		'disc2' => 'float',
		'comm' => 'float',
		'oc' => 'float',
		'ri' => 'float',
		'ricom' => 'float',
		'premium_reserve' => 'float',
		'acceptedclaim' => 'float',
		'rejectclaim' => 'float',
		'outstandingclaim' => 'float',
		'reversedclaim' => 'float',
		'beban_uw' => 'float',
		'biayanonoperasional' => 'float',
		'biayaoperasional' => 'float',
		'investasi' => 'float',
		'bagi_hasil_peserta' => 'float',
		'cadpremi' => 'float',
		'cadpremi1' => 'float',
		'biaya_kantor_pusat' => 'float',
		'cadangan_dana_tabaru' => 'float',
		'zakat' => 'float'
	];

	protected $fillable = [
		'id1',
		'id2',
		'lastrefresh',
		'proddatetime',
		'ldc_id',
		'lbu_id',
		'lag_id',
		'lmo_id',
		'gpw',
		'disc',
		'disc2',
		'comm',
		'oc',
		'ri',
		'ricom',
		'premium_reserve',
		'acceptedclaim',
		'rejectclaim',
		'outstandingclaim',
		'reversedclaim',
		'notes',
		'beban_uw',
		'biayanonoperasional',
		'biayaoperasional',
		'investasi',
		'bagi_hasil_peserta',
		'prodkey',
		'mthname',
		'mthname2',
		'partcol',
		'cadpremi',
		'cadpremi1',
		'biaya_kantor_pusat',
		'cadangan_dana_tabaru',
		'zakat',
		'tipe_surplus',
		'upload_sistem'
	];
}

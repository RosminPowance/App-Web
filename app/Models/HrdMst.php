<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HrdMst
 * 
 * @property string|null $nik
 * @property string|null $mcl_id
 * @property string|null $nama
 * @property string|null $alamat_r
 * @property string|null $kota_r
 * @property string|null $kodepos_r
 * @property string|null $telp_r
 * @property string|null $alamat_ktp
 * @property string|null $telp_ktp
 * @property string|null $wn_ktp
 * @property string|null $no_ktp
 * @property string|null $ktp_dikeluarkan_oleh
 * @property Carbon|null $ktp_berlaku_sd
 * @property string|null $golongan_sim
 * @property string|null $no_sim
 * @property string|null $sim_dikeluarkan_oleh
 * @property Carbon|null $sim_berlaku_sd
 * @property string|null $wn_passport
 * @property string|null $no_passport
 * @property string|null $passport_dikeluarkan_oleh
 * @property Carbon|null $passport_berlaku_sd
 * @property string|null $tmp_lahir
 * @property Carbon|null $tgl_lahir
 * @property string|null $sex
 * @property float|null $tinggi_badan
 * @property string|null $gol_darah
 * @property string|null $lag_id
 * @property string|null $pemilikan_rumah
 * @property string|null $pemilikan_kendaraan
 * @property string|null $jenis_kendaraan
 * @property string|null $merk_kendaraan
 * @property float|null $tahun_kendaraan
 * @property string|null $sts_marital
 * @property Carbon|null $tgl_marital
 * @property string|null $hobby
 * @property string|null $kegiatan_wkt_luang
 * @property string|null $frekwensi_membaca
 * @property string|null $pokok_bacaan
 * @property string|null $koran_bacaan
 * @property string|null $majalah_bacaan
 * @property string|null $nik_atasan
 * @property string|null $sts_seleksi
 * @property string|null $sts_terima
 * @property Carbon|null $tgl_terima
 * @property string|null $kd_gol
 * @property string|null $lde_id
 * @property string|null $ldi_id
 * @property string|null $lca_id
 * @property string|null $lwk_id
 * @property string|null $sts_kry
 * @property Carbon|null $tgl_masuk
 * @property Carbon|null $tgl_peng
 * @property Carbon|null $tgl_keluar
 * @property Carbon|null $tgl_input
 * @property string|null $sts_absen
 * @property string|null $lulusan
 * @property string|null $jabatan
 * @property Carbon|null $tgl_masuk_grup_asm
 * @property string|null $kd_jab
 * @property Carbon|null $tgl_jatuh_tempo
 * @property string|null $email
 * @property string|null $lkr_id
 * @property string|null $cost_no
 * @property Carbon|null $tgl_terima_ijasah
 * @property Carbon|null $tgl_update_terima_ijasah
 * @property string|null $dapat_lembur
 * @property string|null $no_kk
 * @property string|null $no_rt
 * @property string|null $no_rw
 * @property string|null $nama_kecamatan
 * @property string|null $nama_desa
 * @property string|null $login_aplikasi
 * @property string|null $hp_comben
 * @property string|null $email_comben
 * @property string|null $account_comben
 * @property string|null $status_comben
 * @property string|null $lse_id
 * @property string|null $ldc_id
 * @property string|null $case_id
 *
 * @package App\Models
 */
class HrdMst extends Model
{
	protected $table = 'hrd_mst';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ktp_berlaku_sd' => 'datetime',
		'sim_berlaku_sd' => 'datetime',
		'passport_berlaku_sd' => 'datetime',
		'tgl_lahir' => 'datetime',
		'tinggi_badan' => 'float',
		'tahun_kendaraan' => 'float',
		'tgl_marital' => 'datetime',
		'tgl_terima' => 'datetime',
		'tgl_masuk' => 'datetime',
		'tgl_peng' => 'datetime',
		'tgl_keluar' => 'datetime',
		'tgl_input' => 'datetime',
		'tgl_masuk_grup_asm' => 'datetime',
		'tgl_jatuh_tempo' => 'datetime',
		'tgl_terima_ijasah' => 'datetime',
		'tgl_update_terima_ijasah' => 'datetime'
	];

	protected $fillable = [
		'nik',
		'mcl_id',
		'nama',
		'alamat_r',
		'kota_r',
		'kodepos_r',
		'telp_r',
		'alamat_ktp',
		'telp_ktp',
		'wn_ktp',
		'no_ktp',
		'ktp_dikeluarkan_oleh',
		'ktp_berlaku_sd',
		'golongan_sim',
		'no_sim',
		'sim_dikeluarkan_oleh',
		'sim_berlaku_sd',
		'wn_passport',
		'no_passport',
		'passport_dikeluarkan_oleh',
		'passport_berlaku_sd',
		'tmp_lahir',
		'tgl_lahir',
		'sex',
		'tinggi_badan',
		'gol_darah',
		'lag_id',
		'pemilikan_rumah',
		'pemilikan_kendaraan',
		'jenis_kendaraan',
		'merk_kendaraan',
		'tahun_kendaraan',
		'sts_marital',
		'tgl_marital',
		'hobby',
		'kegiatan_wkt_luang',
		'frekwensi_membaca',
		'pokok_bacaan',
		'koran_bacaan',
		'majalah_bacaan',
		'nik_atasan',
		'sts_seleksi',
		'sts_terima',
		'tgl_terima',
		'kd_gol',
		'lde_id',
		'ldi_id',
		'lca_id',
		'lwk_id',
		'sts_kry',
		'tgl_masuk',
		'tgl_peng',
		'tgl_keluar',
		'tgl_input',
		'sts_absen',
		'lulusan',
		'jabatan',
		'tgl_masuk_grup_asm',
		'kd_jab',
		'tgl_jatuh_tempo',
		'email',
		'lkr_id',
		'cost_no',
		'tgl_terima_ijasah',
		'tgl_update_terima_ijasah',
		'dapat_lembur',
		'no_kk',
		'no_rt',
		'no_rw',
		'nama_kecamatan',
		'nama_desa',
		'login_aplikasi',
		'hp_comben',
		'email_comben',
		'account_comben',
		'status_comben',
		'lse_id',
		'ldc_id',
		'case_id'
	];
}

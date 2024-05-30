<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobScheduleSyariah
 * 
 * @property string|null $job
 * @property int|null $day_from
 * @property int|null $day_to
 *
 * @package App\Models
 */
class JobScheduleSyariah extends Model
{
	protected $table = 'job_schedule_syariah';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'day_from' => 'int',
		'day_to' => 'int'
	];

	protected $fillable = [
		'job',
		'day_from',
		'day_to'
	];
}

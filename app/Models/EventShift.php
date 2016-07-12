<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class EventShift extends Model {

	protected $fillable = [
		'event_job_id',
		'user_id',
		'start_at',
		'end_at'
	];

	protected $casts = [
		'event_job_id' => 'integer',
		'user_id' => 'integer',
		'start_at' => 'date',
		'end_at' => 'date'
	];

	protected $rules = [
		'event_job_id' => 'integer,exists:event_jobs',
		'user_id' => 'integer,exists:users',
		'start_at' => 'date',
		'end_at' => 'date'
	];

	protected $dates = [
		'start_at',
		'end_at',
		'deleted_at'
	];

	public function job() {
		return $this->belongsTo('\App\Models\EventJob', 'event_job_id');
	}

	public function event() {
		return $this->job->event();
	}

	public function staff() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}
}

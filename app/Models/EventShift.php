<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class EventShift extends Model {

	protected $fillable = [
		'job_id',
		'start_at',
		'end_at',
		'user_id'
	];

	protected $casts = [
		'job_id' => 'integer',
		'start_at' => 'date',
		'end_at' => 'date',
		'user_id' => 'integer'
	];

	protected $rules = [
		'job_id' => 'integer,exists:event_jobs',
		'start_at' => 'date',
		'end_at' => 'date',
		'user_id' => 'integer,exists:users'
	];

	protected $dates = [
		'start_at',
		'end_at',
		'deleted_at'
	];

	public function job() {
		return $this->belongsTo('\App\Models\EventJob');
	}

	public function event() {
		return $this->job->event;
	}

	public function staff() {
		return $this->belongsTo('\App\Models\User', 'user_id');
	}
}

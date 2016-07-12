<?php

namespace App\Models;

use GrizzDev\CMS\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Event extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'title',
		'save_to' => 'slug',
		'on_update' => false
	];

	protected $fillable = [
		'title',
		'description',
		'venue',
		'address',
		'city',
		'state_id',
		'zip',
		'lead_id',
		'start_at',
		'end_at'
	];

	protected $casts = [
		'title' => 'string',
		'description' => 'string',
		'venue' => 'string',
		'address' => 'string',
		'city' => 'string',
		'state_id' => 'integer',
		'zip' => 'string',
		'lead_id' => 'integer',
		'start_at' => 'datetime',
		'end_at' => 'datetime'
	];

	protected $rules = [
		'title' => 'string,max:128',
		'description' => 'string,NULL',
		'venue' => 'string,NULL',
		'address' => 'string',
		'city' => 'string,max:32',
		'state_id' => 'integer,exists:states',
		'zip' => 'string,max:10',
		'lead_id' => 'integer:exists:users',
		'start_at' => 'date',
		'end_at' => 'date'
	];

	protected $dates = [
		'start_at',
		'end_at',
		'deleted_at'
	];

	protected $listConfig = [
		'id' => [
			'label' => '#',
			'sortable' => false,
			'format' => 'linkFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'title' => [
			'label' => 'Event',
			'sortable' => false,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'start_at' => [
			'label' => 'Start',
			'sortable' => true,
			'format' => 'datetimeFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'end_at' => [
			'label' => 'End',
			'sortable' => true,
			'format' => 'datetimeFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'location' => [
			'label' => 'Location',
			'sortable' => true,
			'format' => 'locationFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'lead_id' => [
			'label' => 'Lead',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => true
		]
	];

	public function jobs() {
		return $this->hasMany('\App\Models\EventJob');
	}

	public function shifts() {
		return $this->hasManyThrough('\App\Models\EventShift', '\App\Models\EventJob');
	}

	public function state() {
		return $this->belongsTo('\App\Models\State');
	}

	public function getLocationAttribute() {
		return $this->location();
	}

	public function location() {
		$string = '';

		if ($this->venue) {
			$string .= $this->venue.', ';
		}

		if ($this->address) {
			$string .= $this->address.', ';
		}

		$string .= $this->city.', '.$this->state->name;

		return $string;
	}

	public function lead() {
		return $this->belongsTo('\App\Models\User', 'lead_id');
	}

}

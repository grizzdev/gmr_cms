<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class State extends Model {

	protected $fillable = [
		'id',
		'name',
		'enabled',
		'country_id'
	];

	public function country() {
		return $this->hasOne('App\Models\Country');
	}

	public function cities() {
		return $this->hasMany('App\Models\City');
	}
}

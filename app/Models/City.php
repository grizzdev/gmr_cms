<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class City extends Model {

	protected $fillable = [
		'id',
		'name',
		'state_id'
	];

	public function state() {
		return $this->belongsTo('App\Models\State');
	}
}

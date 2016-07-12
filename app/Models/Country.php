<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Country extends Model {

	protected $fillable = [
		'id',
		'name'
	];

	public function states() {
		return $this->hasMany('App\Models\State');
	}
}

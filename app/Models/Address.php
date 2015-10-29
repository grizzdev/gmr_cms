<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Address extends Model {

	protected $table = 'addresses';

	protected $fillable = [
		'name',
		'address_1',
		'address_2',
		'city',
		'state_id',
		'zip',
		'country_id',
		'user_id',
		'is_billing',
		'is_shipping'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $casts = [
		'state_id' => 'integer',
		'country_id' => 'integer',
		'user_id' => 'integer',
		'is_billing' => 'boolean',
		'is_shipping' => 'boolean'
	];

	public function state() {
		return $this->belongsTo('\App\Models\Location', 'state_id');
	}

	public function country() {
		return $this->belongsTo('\App\Models\Location', 'country_id');
	}

}

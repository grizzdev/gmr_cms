<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class ItemAttribute extends Model {

	protected $table = 'item_attributes';

	protected $fillable = [
		'item_id',
		'attribute_id',
		'value'
	];

	public function attribute() {
		return $this->belongsTo('\App\Models\Attribute');
	}

}

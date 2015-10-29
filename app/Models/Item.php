<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Item extends Model {

	protected $table = 'items';

	protected $fillable = [
		'product_id',
		'quantity',
		'hero_id',
		'cart_id',
		'status_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $casts = [
		'product_id' => 'integer',
		'quantity' => 'integer',
		'hero_id' => 'integer',
		'cart_id' => 'integer',
		'status_id' => 'integer'
	];

	public function product() {
		return $this->belongsTo('\App\Models\Product');
	}

	public function hero() {
		return $this->belongsTo('\App\Models\Hero');
	}

	public function itemAttributes() {
		return $this->hasMany('\App\Models\ItemAttribute');
	}

	public function price() {
		$price = $this->product->price;

		foreach ($this->itemAttributes as $attribute) {
			if ($attribute->attribute->name == 'Amount') {
				$price += $attribute->value;
			} elseif ($attribute->attribute->price) {
				$price += $attribute->attribute->price;
			} elseif ($attribute->attribute->type == 'select') {
				$attr = \App\Attribute::find($attribute->value);
				if ($attr->price) {
					$price += $attr->price;
				}
			}
		}

		return $price;
	}

	public function contribution() {
		if ($this->product->id == 1) { // donation
			return $this->price();
		} else {
			return ($this->product->contribution_amount * $this->quantity);
		}
	}

	public function status() {
		return $this->belongsTo('\App\Models\Status');
	}

}

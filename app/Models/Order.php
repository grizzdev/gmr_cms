<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Order extends Model {

	protected $table = 'orders';

	protected $fillable = [
		'user_id',
		'cart_id',
		'payment_method_id',
		'payment_token',
		'payment_id',
		'payment_status_id',
		'status_id',
		'billing_address_id',
		'shipping_address_id',
		'meta',
		'notes'
	];

	protected $formConfig = [
	];

	protected $listConfig = [
		'id' => [
			'label' => '#',
			'sortable' => false,
			'format' => 'idLinkFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'user' => [
			'label' => 'Customer',
			'sortable' => false,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'status' => [
			'label' => 'Status',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'payment_status' => [
			'label' => 'Payment Status',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'created_at' => [
			'label' => 'Order Date',
			'sortable' => true,
			'format' => 'datetimeFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'updated_at' => [
			'label' => 'Updated',
			'sortable' => true,
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true,
		]
	];

	public function getTotalAttribute($value) {
		return $this->cart->total();
	}

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function cart() {
		return $this->belongsTo('App\Models\Cart');
	}

	public function status() {
		return $this->belongsTo('App\Models\Status');
	}

	public function payment_status() {
		return $this->belongsTo('App\Models\Status', 'payment_status_id');
	}

	public function billing_address() {
		return $this->belongsTo('App\Models\Address', 'billing_address_id');
	}

	public function shipping_address() {
		return $this->belongsTo('App\Models\Address', 'shipping_address_id');
	}

	public function payment() {
		return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id');
	}

}

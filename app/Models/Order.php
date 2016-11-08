<?php

namespace App\Models;

use Carbon\Carbon;
use GrizzDev\CMS\Model;

class Order extends Model {

	#protected $table = 'orders';
	protected $table = 'neworders';

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
		'shipping_address' => [
			'label' => 'Ship Address',
			'sortable' => false,
			'format' => null,
			'mobile' => false,
			'switchable' => true
		],
		'status' => [
			'label' => 'Status',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => true
		],
		'payment_status' => [
			'label' => 'Payment Status',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => true
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

	public function getHasProduct($product_id, $start = null, $end = null) {
		$start = (empty($start)) ? $start = mktime(0,0,0,0,0,0) : $start = strtotime($start);
		$end = (empty($end)) ? mktime(11,59,59,12,31,2021) : strtotime($end);

		$cart_ids = [];

		foreach(Item::where('product_id', '=', $product_id)->get() as $item) {
			$cart_ids[] = $item->cart->id;
		}

		return $this->whereIn('status_id', [1, 2, 3])
			->where('created_at', '>=', Carbon::createFromTimestamp($start)->toDateString())
			->where('created_at', '<=', Carbon::createFromTimestamp($end)->toDateString())
			->whereIn('cart_id', $cart_ids)->orderBy('created_at', 'asc')
			->get();
	}

}

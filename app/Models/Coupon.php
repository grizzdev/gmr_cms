<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Coupon extends Model {

	protected $table = 'coupons';

	protected $fillable = [
		'code',
		'type',
		'amount',
		'uses',
		'used',
		'minimum_amount',
		'before_tax',
		'products_json',
		'categories_json',
		'users_json',
		'expires_at'
	];

	protected $dates = [
		'deleted_at',
		'expires_at'
	];

	protected $listConfig = [
		'id' => [
			'label' => '',
			'sortable' => false,
			'format' => 'linkFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'code' => [
			'label' => 'Name',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'type' => [
			'label' => 'Type',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'amount' => [
			'label' => 'Value',
			'sortable' => true,
			'format' => 'amountFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'used' => [
			'label' => 'Used',
			'sortable' => true,
			'format' => null,
			'mobile' => false,
			'switchable' => false
		],
		'expires_at' => [
			'label' => 'Expires',
			'sortable' => true,
			'format' => 'datetimeFormatter',
			'mobile' => true,
			'switchable' => false
		]
	];

	protected $formConfig = [
		'id' => [
			'label' => '',
			'type' => 'hidden',
			'confirmed' => false
		],
		'code' => [
			'label' => 'Code',
			'type' => 'text',
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'type' => [
			'label' => 'Type',
			'type' => 'select',
			'options' => [
				'fixed' => 'fixed',
				'percentage' => 'percentage',
				'shipping' => 'shipping'
			],
			'required' => true,
			'disabled' => false
		],
		'amount' => [
			'label' => 'Amount',
			'type' => 'decimal',
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'uses' => [
			'label' => 'Max. Uses',
			'type' => 'number',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'minimum_amount' => [
			'label' => 'Min. Purchase Amount',
			'type' => 'dollar',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'expires_at' => [
			'label' => 'Expires',
			'type' => 'date',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'products_json' => [
			'label' => 'Products',
			'type' => 'model',
			'model' => '\App\Models\Product',
			'field' => 'name',
			'confirmed' => false,
			'required' => false,
			'disabled' => false,
			'multiple' => true
		],
		'categories_json' => [
			'label' => 'Categories',
			'type' => 'model',
			'model' => '\App\Models\Category',
			'field' => 'name',
			'confirmed' => false,
			'required' => false,
			'disabled' => false,
			'multiple' => true
		],
	];

	public function getProductsAttribute() {
		return json_decode($this->products_json);
	}

	public function setProductsAttribute($data = []) {
		$this->products_json = json_encode($data);
	}

	public function getCategoriesAttribute() {
		return json_decode($this->categories_json);
	}

	public function setCategoriesAttribute($data = []) {
		$this->categories_json = json_encode($data);
	}

	public function getUsersAttribute() {
		return json_decode($this->users_json);
	}

	public function setUsersAttribute($data = []) {
		$this->users_json = json_encode($data);
	}

}

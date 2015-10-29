<?php

namespace App\Models;

use GrizzDev\CMS\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Attribute extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $table = 'attributes';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'price',
		'type',
		'model',
		'parent_id'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

	protected $formConfig = [
		'id' => [
			'label' => '',
			'type' => 'hidden',
			'confirmed' => false
		],
		'name' => [
			'label' => 'Name',
			'type' => 'text',
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'slug' => [
			'label' => 'Slug',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => 'disabled'
		],
		'price' => [
			'label' => 'Price',
			'type' => 'decimal',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'parent_id' => [
			'label' => 'Parent Attribute',
			'type' => 'model',
			'model' => '\App\Models\Attribute',
			'field' => 'name',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'type' => [
			'label' => 'Type',
			'type' => 'select',
			'options' => [
				null => null,
				'select' => 'select',
				'text' => 'text',
				'number' => 'number',
				'model' => 'model',
				'currency' => 'currency'
			],
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'model' => [
			'label' => 'Model',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'description' => [
			'label' => 'Description',
			'type' => 'textarea',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
	];

	protected $listConfig = [
		'id' => [
			'label' => '',
			'sortable' => false,
			'format' => 'linkFormatter',
			'mobile' => true,
			'switchable' => false
		],
		'name' => [
			'label' => 'Name',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'slug' => [
			'label' => 'Slug',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		//'description' => [],
		'price' => [
			'label' => 'Price',
			'sortable' => true,
			'format' => 'currencyFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'type' => [
			'label' => 'Type',
			'sortable' => true,
			'format' => false,
			'mobile' => false,
			'switchable' => true
		],
		'model' => [
			'label' => 'Model',
			'sortable' => true,
			'format' => false,
			'mobile' => false,
			'switchable' => true
		]
	];

	public function products() {
		return $this->belongsToMany('App\Product')->withTimestamps();
	}

	public function parent() {
		return $this->belongsTo('App\Attribute', 'parent_id');
	}

	public function children() {
		return $this->hasMany('App\Attribute', 'parent_id');
	}

}

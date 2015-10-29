<?php

namespace App\Models;

use GrizzDev\CMS\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $table = 'categories';

	protected $fillable = [
		'name',
		'slug',
		'description',
		'file_id',
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
		'parent_id' => [
			'label' => 'Parent Category',
			'type' => 'model',
			'model' => '\App\Models\Category',
			'field' => 'name',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'file_id' => [
			'label' => 'Image',
			'type' => 'file',
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
		]
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
		]
	];

	public function file() {
		return $this->belongsTo('App\File');
	}

	public function parent() {
		return $this->belongsTo('App\Category', 'parent_id');
	}

	public function children() {
		return $this->hasMany('App\Category', 'parent_id');
	}

	public function products() {
		return $this->belongsTo('App\Product');
	}

}

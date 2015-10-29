<?php

namespace App\Models;

use GrizzDev\CMS\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tag extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $table = 'tags';

	protected $fillable = [
		'name',
		'slug',
		'description'
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

	public function products() {
		return $this->belongsToMany('App\Product')->withTimestamps();
	}

}

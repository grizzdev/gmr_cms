<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Location extends Model {

	protected $table = 'locations';

	protected $fillable = [
		'name',
		'code',
		'type',
		'active',
		'parent_id'
	];

	protected $hidden = [
	];

	protected $dates = [
		'deleted_at'
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
				0 => 'Country',
				1 => 'State/Province',
				2 => 'City'
			],
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'parent_id' => [
			'label' => 'Parent',
			'type' => 'model',
			'model' => '\App\Models\Location',
			'field' => 'name',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'active' => [
			'label' => 'Active',
			'type' => 'select',
			'options' => [
				0 => 'No',
				1 => 'Yes'
			],
			'confirmed' => false,
			'required' => 'required',
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
			'switchable' => true
		],
		'code' => [
			'label' => 'Code',
			'sortable' => true,
			'format' => null,
			'mobile' => true,
			'switchable' => true
		],
		'type' => [
			'label' => 'Type',
			'sortable' => true,
			'format' => 'locationTypeFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'active' => [
			'label' => 'Active',
			'sortable' => true,
			'format' => 'booleanFormatter',
			'mobile' => true,
			'switchable' => true
		]
	];

	public function children() {
		return $this->hasMany('App\Location', 'parent_id');
	}

	public static function countries() {
		return self::where('type', '=', 0)->where('active', '=', 1)->orderBy('name')->get();
	}

	public static function states($parent_id = null) {
		if ($parent_id) {
			return self::where('type', '=', 1)->where('active', '=', 1)->where('parent_id', '=', $parent_id)->orderBy('name')->get();
		} else {
			return self::where('type', '=', 1)->where('active', '=', 1)->orderBy('name')->get();
		}
	}

	public static function cities($parent_id = null) {
		if ($parent_id) {
			return self::where('type', '=', 2)->where('active', '=', 1)->where('parent_id', '=', $parent_id)->orderBy('name')->get();
		} else {
			return self::where('type', '=', 2)->where('active', '=', 1)->orderBy('name')->get();
		}
	}

}

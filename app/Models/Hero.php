<?php

namespace App\Models;

use GrizzDev\CMS\Model;
use App\Models\Location;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Hero extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'name',
	];

	protected $table = 'heroes';

	protected $fillable = [
		'name',
		'email_address',
		'phone_number',
		'overview',
		'description',
		'birth_date',
		'gender',
		'shirt_size',
		'cancer_type',
		'facebook_url',
		'twitter_url',
		'youtube_url',
		'caringbridge_url',
		'active',
		'funded',
		'address_id',
		'hospital_id',
		'nominee_id',
		'goal',
		'raised'
	];

	protected $hidden = [
	];

	protected $dates = [
		'deleted_at'
	];

	protected $rules = [
		'name' => 'required|alpha'
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
			'required' => true,
			'disabled' => false
		],
		'slug' => [
			'label' => 'Slug',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => true
		],
		'active' => [
			'label' => 'Active',
			'type' => 'select',
			'options' => [
				0 => 'No',
				1 => 'Yes'
			],
			'required' => true,
			'disabled' => false
		],
		'funded' => [
			'label' => 'Funded',
			'type' => 'select',
			'options' => [
				0 => 'No',
				1 => 'Yes'
			],
			'required' => true,
			'disabled' => false
		],
		'goal' => [
			'label' => 'Goal',
			'type' => 'dollar',
			'confirmed' => false,
			'required' => true,
			'disabled' => false,
		],
		'raised' => [
			'label' => 'Raised',
			'type' => 'dollar',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'birth_date' => [
			'label' => 'Birth Date',
			'type' => 'date',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'gender' => [
			'label' => 'Gender',
			'type' => 'select',
			'options' => [
				'm' => 'Male',
				'f' => 'Female'
			],
			'required' => true,
			'disabled' => false
		],
		'address' => [
			'label' => 'Address',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'city' => [
			'label' => 'City',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'state_id' => [
			'label' => 'State',
			'type' => 'state',
			'required' => true,
			'disabled' => false
		],
		'zip' => [
			'label' => 'Zip',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'shirt_size' => [
			'label' => 'Shirt Size',
			'type' => 'select',
			'options' => [
				'ys' => 'YS',
				'ym' => 'YM',
				'yl' => 'YL',
				'yxl' => 'YXL',
				's' => 'S',
				'm' => 'M',
				'l' => 'L',
				'xl' => 'XL'
			],
			'required' => true,
			'disabled' => false
		],
		'cancer_type' => [
			'label' => 'Cancer Type',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'hospital_name' => [
			'label' => 'Hospital',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'hospital_location' => [
			'label' => 'Location',
			'type' => 'text',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'facebook_url' => [
			'label' => 'Facebook URL',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'twitter_url' => [
			'label' => 'Twitter URL',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'youtube_url' => [
			'label' => 'YouTube URL',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'caringbridge_url' => [
			'label' => 'CaringBridge URL',
			'type' => 'text',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'overview' => [
			'label' => 'Overview',
			'type' => 'textarea',
			'confirmed' => false,
			'required' => true,
			'disabled' => false
		],
		'description' => [
			'label' => 'Description',
			'type' => 'textarea',
			'confirmed' => false,
			'required' => false,
			'disabled' => false
		],
		'file_id' => [
			'label' => 'Image',
			'type' => 'file',
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
			'switchable' => true
		],
		'birth_date' => [
			'label' => 'Birth Date',
			'type' => 'date',
			'format' => 'dateFormatter',
			'sortable' => true,
			'mobile' => false,
			'switchable' => true
		],
		'gender' => [
			'label' => 'Gender',
			'type' => 'text',
			'sortable' => true,
			'format' => 'genderFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'goal' => [
			'label' => '$ Goal',
			'sortable' => true,
			'format' => 'currencyFormatter',
			'mobile' => false,
			'switchable' => true
		],
		'raised' => [
			'label' => '$ Raised',
			'sortable' => true,
			'format' => 'currencyFormatter',
			'mobile' => false,
			'switchable' => true
		],
		'active' => [
			'label' => 'Active',
			'sortable' => true,
			'format' => 'booleanFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'funded' => [
			'label' => 'Funded',
			'sortable' => true,
			'format' => 'booleanFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'created_at' => [
			'label' => 'Created',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true
		],
		'updated_at' => [
			'label' => 'Updated',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true
		]
	];

	public function address() {
	}

	public function hospital() {
	}

	public function nominee() {
	}

	public function packages() {
	}

}

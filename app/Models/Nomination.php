<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Nomination extends Model {

	protected $table = 'nominations';

	protected $fillable = [
		'name',
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
		'file_id',
		'address_id',
		'hospital_id',
		'nominee_id',
		'relationship'
	];

	protected $hidden = [
	];

	protected $dates = [
		'birth_date',
		'deleted_at'
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

}

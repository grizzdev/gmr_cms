<?php

namespace App\Models;

use DB;
use GrizzDev\CMS\Model;
use App\Models\Hero;
use App\Models\Location;

class Nomination extends Model {

	protected $table = 'nominations';

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
			'format' => 'nominationFormatter',
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
		'cancer_type' => [
			'label' => 'Cancer',
			'sortable' => false,
			'format' => null,
			'mobile' => true,
			'switchable' => false
		],
		'created_at' => [
			'label' => 'Created',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => false,
			'switchable' => true
		]
	];

	public function state() {
		return $this->belongsTo('App\Models\Location', 'state_id');
	}

	public function hospital() {
	}

	public function nominee() {
		return $this->belongsTo('App\Models\User', 'nominee_id');
	}

	public function image() {
		return $this->belongsTo('App\Models\File', 'file_id');
	}

	public function toHero() {
		if ($this->id) {
			$hero = Hero::create([
				'name' => $this->name,
				'email_address' => $this->email_address,
				'phone_number' => $this->phone_number,
				'overview' => $this->overview,
				'description' => $this->description,
				'birth_date' => $this->birth_date,
				'gender' => $this->gender,
				'address' => $this->address,
				'city' => $this->city,
				'state_id' => $this->state_id,
				'zip' => $this->zip,
				'shirt_size' => $this->shirt_size,
				'hospital_name' => $this->hospital_name,
				'hospital_location' => $this->hospital_location,
				'cancer_type' => $this->cancer_type,
				'facebook_url' => $this->facebook_url,
				'twitter_url' => $this->twitter_url,
				'youtube_url' => $this->youtube_url,
				'caringbridge_url' => $this->caringbridge_url,
				'goal' => 500,
				'raised' => 0,
				'active' => 1,
				'funded' => 0,
				'file_id' => $this->file_id,
				'nominee_id' => $this->nominee_id,
			]);

			DB::table('hero_package')->insert([
				'hero_id' => $hero->id,
				'package_id' => 2
			]);

			$this->delete();

			return $hero;
		}
	}

}

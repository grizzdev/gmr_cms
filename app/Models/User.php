<?php

/**
 * Class and Function List:
 * Function list:
 * Classes list:
 * - User extends Model
 */

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use GrizzDev\CMS\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table	= 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden   = [
		'password',
		'remember_token'
	];

	protected $formConfig = [
		'name' => [
			'label' => 'Name',
			'type' => 'text',
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'email' => [
			'label' => 'Email Address',
			'type' => 'email',
			'confirmed' => false,
			'required' => 'required',
			'disabled' => false
		],
		'password' => [
			'label' => 'Password',
			'type' => 'password',
			'confirmed' => true,
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
			'mobile' => true,
			'switchable' => true,
			'format' => null
		],
		'email' => [
			'label' => 'Email Address',
			'sortable' => true,
			'mobile' => true,
			'switchable' => true,
			'format' => null
		],
		'created_at' => [
			'label' => 'Created',
			'sortable' => true,
			'type' => 'datetime',
			'format' => 'datetimeFormatter',
			'mobile' => true,
			'switchable' => true
		],
		'updated_at' => [
			'label' => 'Updated',
			'sortable' => true,
			'type' => 'datetime',
			'format' => null,
			'mobile' => true,
			'switchable' => true
		]
	];

	public function orders() {
		return $this->hasMany('App\Models\Order');
	}

}

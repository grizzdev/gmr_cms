<?php

namespace App\Models;

use GrizzDev\CMS\Model;

class Status extends Model {

	protected $table = 'statuses';

	protected $fillable = [
		'name'
	];

}

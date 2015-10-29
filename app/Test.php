<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model {

	protected $table = "tags";

	protected $fillable = [
		'name',
		'slug',
		'description'
	];

}

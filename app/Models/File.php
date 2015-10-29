<?php
namespace App\Models;

use GrizzDev\CMS\Model;

class File extends Model {

	protected $table = 'files';

	protected $fillable = [
		'path',
		'name',
		'mime',
		'size'
	];

	protected $dates = [
		'deleted_at'
	];

	protected $formConfig = [
	];

	protected $listConfig = [
	];

	public function url() {
		return $this->path.$this->name;
	}

}

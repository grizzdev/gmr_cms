<?php

namespace GrizzDev\CMS;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Former\Facades\Former;

class Model extends \Illuminate\Database\Eloquent\Model {

	use SoftDeletes, SearchableTrait;

	protected $formConfig = [];

	public function getFormConfig($field = null) {
		if ($field && array_key_exists($field, $this->formConfig)) {
			return $this->formConfig[$field];
		} else {
			return $this->formConfig;
		}
	}

	protected $listConfig = [];

	public function getListConfig($field = null) {
		if ($field && array_key_exists($field, $this->listConfig)) {
			return $this->listConfig($field);
		} else {
			return $this->listConfig;
		}
	}

}

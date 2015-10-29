<?php

namespace GrizzDev\CMS;

class Form {

	public static function render($model) {
		if (is_object($model)) {
			return view('vendor.grizzdev.cms.form', ['model' => $model]);
		}
	}

	public static function field($model, $field, $data) {
		return view('vendor.grizzdev.cms.fields.'.$data['type'], [
			'model' => $model,
			'field' => $field,
			'data' => $data
		]);
	}

}

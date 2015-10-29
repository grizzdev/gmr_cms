<?php

namespace GrizzDev\CMS;

class Listing {

	public static function render($model) {
		if (is_object($model)) {
			return view('vendor.grizzdev.cms.list', ['model' => $model]);
		}
	}

}

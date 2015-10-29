<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class AttributeController extends Controller {

	public function index() {
		return Listing::render(new Attribute);
	}

	public function create() {
		return Form::render(new Attribute);
	}

	public function store(Request $request) {
		$attribute = Attribute::create([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
			'price' => $request->input('price'),
			'type' => $request->input('type'),
			'model' => $request->input('model'),
			'parent_id' => $request->input('parent_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/attributes/'.$attribute->id)]);
		} else {
			return redirect()->back();
		}
	}

	public function show($id) {
		return Form::render(Attribute::find($id));
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		Attribute::find($id)->update([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
			'price' => $request->input('price'),
			'type' => $request->input('type'),
			'model' => $request->input('model'),
			'parent_id' => $request->input('parent_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/attributes')]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
		Attribute::find($id)->delete();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/attributes')]);
		} else {
			return redirect()->back();
		}
	}
}

<?php

namespace App\Http\Controllers\CMS\Site;

use Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class LocationController extends Controller {

	public function index() {
		return Listing::render(new Location);
	}

	public function create() {
		return Form::render(new Location);
	}

	public function store(Request $request) {
		$location = Location::create([
			'name' => $request->input('name'),
			'code' => $request->input('code'),
			'type' => $request->input('type'),
			'active' => $request->input('active'),
			'parent_id' => $request->input('parent_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('cms/site/locations/'.$location->id)]);
		} else {
			return redirect()->back();
		}
	}

	public function show($id) {
		return Form::render(Location::find($id));
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		Location::find($id)->update([
			'name' => $request->input('name'),
			'code' => $request->input('code'),
			'type' => $request->input('type'),
			'active' => $request->input('active'),
			'parent_id' => $request->input('parent_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('cms/site/locations')]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
		Location::find($id)->delete();

		if ($request->ajax()) {
			return Response::json(['href' => url('cms/site/locations')]);
		} else {
			return redirect()->back();
		}
	}

}

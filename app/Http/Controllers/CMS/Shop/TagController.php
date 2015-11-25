<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;
use Former\Facades\Former;

class TagController extends Controller {

	public function index() {
		return Listing::render(new Tag);
	}

	public function create() {
		return Form::render(new Tag);
	}

	public function store(Request $request) {
		$tag = Tag::create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/tags/'.$tag->id)]);
		} else {
			return redirect()->back();
		}
	}

	public function show($id) {
		return Form::render(Tag::find($id));
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		Tag::find($id)->update([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/tags')]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
		Tag::find($id)->delete();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/tags')]);
		} else {
			return redirect()->back();
		}
	}

}

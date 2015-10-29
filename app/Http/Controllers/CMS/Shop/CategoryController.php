<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class CategoryController extends Controller {

	public function index() {
		return Listing::render(new Category);
	}

	public function create() {
		return Form::render(new Category);
	}

	public function store(Request $request) {
		$category = Category::create([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
			'parent_id' => $request->input('parent_id'),
			'file_id' => $request->input('file_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/categories/'.$category->id)]);
		} else {
			return redirect()->back();
		}
	}

	public function show($id) {
		return Form::render(Category::find($id));
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		Category::find($id)->update([
			'name' => $request->input('name'),
			'description' => $request->input('description'),
			'parent_id' => $request->input('parent_id'),
			'file_id' => $request->input('file_id')
		]);

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/categories')]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
		Category::find($id)->delete();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/categories')]);
		} else {
			return redirect()->back();
		}
	}
}

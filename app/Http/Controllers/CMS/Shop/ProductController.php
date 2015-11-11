<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use DB;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class ProductController extends Controller {

	public function index() {
		return Listing::render(new Product);
	}

	public function create() {
		return Form::render(new Product);
	}

	public function store(Request $request) {
	}

	public function show($id) {
		return view('cms.products.form', [
			'product' => Product::find($id)
		]);
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		$product = Product::find($id);

		$product->update([
			'name' => $request->input('name'),
			'price' => $request->input('price'),
			'sale_price' => $request->input('sale_price'),
			'cost' => $request->input('cost'),
			'contribution_amount' => $request->input('contribution_amount'),
			'description' => $request->input('description'),
			'short_description' => $request->input('short_description'),
			'active' => $request->input('active'),
		]);

		$product->save();

		DB::table('attribute_product')->where('product_id', '=', $product->id)->delete();

		if (is_array($request->input('attribute'))) {
			foreach ($request->input('attribute') as $id => $attrs) {
				DB::table('attribute_product')->insert([
					'attribute_id' => $id,
					'product_id' => $product->id
				]);

				foreach ($attrs as $attr) {
					DB::table('attribute_product')->insert([
						'attribute_id' => $attr,
						'product_id' => $product->id
					]);
				}
			}
		}
	}

	public function destroy(Request $request, $id) {
	}

}

<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use DB;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;
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
			'active' => $request->input('active')
		]);

		$product->save();

		DB::table('attribute_product')->where('product_id', '=', $product->id)->delete();

		if (!in_array($product->id, [221, 220])) {
			DB::table('attribute_product')->insert([
				'product_id' => $product->id,
				'attribute_id' => 39
			]);
		}

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

		DB::table('product_tag')->where('product_id', '=', $product->id)->delete();

		if ($request->input('tags')) {
			$tags = preg_split('/,/', $request->input('tags'));
			foreach ($tags as $tag) {
				$t = Tag::firstOrCreate(['name' => $tag]);

				DB::table('product_tag')->insert([
					'product_id' => $product->id,
					'tag_id' => $t->id
				]);
			}
		}

		DB::table('category_product')->where('product_id', '=', $product->id)->delete();

		if (is_array($request->input('categories'))) {
			foreach ($request->input('categories') as $cat_id) {
				DB::table('category_product')->insert([
					'category_id' => $cat_id,
					'product_id' => $product->id
				]);
			}
		}
	}

	public function destroy(Request $request, $id) {
	}

}

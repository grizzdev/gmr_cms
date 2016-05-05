<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class ReportController extends Controller
{

	public function orders(Request $request) {
		if ($request->input('user_name')) {
			$users = User::where('name', 'LIKE' , '%'.$request->input('user_name').'%')->get();
		} else {
			$users = null;
		}

		return view('cms.reports.orders', ['request' => $request, 'users' => $users]);
	}

	public function products(Request $request) {
		$products = Product::withTrashed()->lists('name', 'id');

		if ($request->input('product_id')) {
			$orders = (new Order)->getHasProduct($request->input('product_id'), $request->input('start_at'), $request->input('end_at'));
		} else {
			$orders = null;
		}

		return view('cms.reports.products', ['request' => $request, 'products' => $products, 'orders' => $orders]);
	}

}

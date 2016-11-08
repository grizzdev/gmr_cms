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
			$orders = null;
		} elseif($request->input('start_at') && $request->input('end_at')) {
			$users = null;
			$orders = Order::where('created_at', '>=', $request->input('start_at').' 00:00:00')->where('created_at', '<=', $request->input('end_at').' 23:59:59')->get();
		} else {
			$users = null;
			$orders = null;
		}

		return view('cms.reports.orders', ['request' => $request, 'users' => $users, 'orders' => $orders]);
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

<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class CouponController extends Controller {

	public function index() {
		return Listing::render(new Coupon);
	}

	public function create() {
		return Form::render(new Coupon);
	}

	public function store(Request $request) {
		$coupon = Coupon::create([
			'code' => $request->input('code'),
			'type' => $request->input('type'),
			'uses' => $request->input('uses'),
			'minimum_amount' => ($request->input('minimum_amount')) ? $request->input('minimum_amount') : null,
			'expires_at' => ($request->input('expires_at')) ? $request->input('expires_at') : null,
		]);

		if ($coupon->type == 'percentage') {
			if ($request->input('amount') >= 1) {
				$coupon->amount = ($request->input('amount') / 100);
			} else {
				$coupon->amount = $request->input('amount');
			}
		} else {
			$coupon->amount = $request->input('amount');
		}

		if ($request->input('products_json')) {
			$coupon->products_json = json_encode($request->input('products_json'));
		}

		if ($request->input('categories_json')) {
			$coupon->categories_json = json_encode($request->input('categories_json'));
		}

		$coupon->save();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/coupons/'.$coupon->id)]);
		} else {
			return redirect()->back();
		}
	}

	public function show($id) {
		return Form::render(Coupon::find($id));
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		$coupon = Coupon::find($id);

		$coupon->update([
			'code' => $request->input('code'),
			'type' => $request->input('type'),
			'uses' => $request->input('uses'),
			'minimum_amount' => ($request->input('minimum_amount')) ? $request->input('minimum_amount') : null,
			'expires_at' => ($request->input('expires_at')) ? $request->input('expires_at') : null,
		]);

		if ($coupon->type == 'percentage') {
			if ($request->input('amount') >= 1) {
				$coupon->amount = ($request->input('amount') / 100);
			} else {
				$coupon->amount = $request->input('amount');
			}
		} else {
			$coupon->amount = $request->input('amount');
		}

		if ($request->input('products_json')) {
			$coupon->products_json = json_encode($request->input('products_json'));
		}

		if ($request->input('categories_json')) {
			$coupon->categories_json = json_encode($request->input('categories_json'));
		}

		$coupon->save();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/coupons')]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
		Coupon::find($id)->delete();

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/coupons')]);
		} else {
			return redirect()->back();
		}
	}
}

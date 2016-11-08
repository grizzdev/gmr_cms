<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use DB;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class OrderController extends Controller {

	public function index() {
		return view('cms.orders.list', [
			'model' => new Order
		]);
		//return Listing::render(new Order);
	}

	public function create() {
		return Form::render(new Order);
	}

	public function store(Request $request) {
		echo 'store';
	}

	public function show($id) {
		return view('cms.orders.form', [
			'order' => Order::find($id)
		]);
	}

	public function edit($id) {
	}

	public function update(Request $request, $id) {
		$order = Order::find($id);

		$order->status_id = $request->input('order')['status_id'];
		$order->payment_status_id = $request->input('order')['payment_status_id'];
		$order->notes = $request->input('notes');
		$order->save();

		if (!empty($request->input('items'))) {
			foreach ($request->input('items') as $aid => $aitem) {
				$item = Item::find($aid);
				$item->status_id = $aitem['status_id'];
				$item->save();
			}
		}

		if ($request->ajax()) {
			return Response::json(['href' => url('shop/orders/'.$id)]);
		} else {
			return redirect()->back();
		}
	}

	public function destroy(Request $request, $id) {
	}

	public function data(Request $request) {
		$orders = Order::skip($request->input('skip'))->take($request->input('take'))
			->join('statuses AS status', 'neworders.status_id', '=', 'status.id')
			->join('users AS user', 'neworders.user_id', '=', 'user.id')
			->join('addresses AS shipping_address', 'neworders.shipping_address_id', '=', 'shipping_address.id')
			->join('addresses AS billing_address', 'neworders.billing_address_id', '=', 'billing_address.id')
			->join('states AS shipping_state', 'shipping_address.state_id', '=', 'shipping_state.id')
			->join('states AS billing_state', 'billing_address.state_id', '=', 'billing_state.id')
			->join('statuses AS payment_status', 'neworders.payment_status_id', '=', 'payment_status.id')
			->select(DB::raw("
				neworders.*,
				status.name AS status,
				user.name AS user,
				payment_status.name AS payment_status,
				CONCAT(billing_address.address_1, ', ', billing_address.city, ', ', billing_state.name, ' ', billing_address.zip) AS billing_address,
				CONCAT(shipping_address.address_1, ', ', shipping_address.city, ', ', shipping_state.name, ' ', shipping_address.zip) AS shipping_address
			"));

		foreach ($orders as $key => $order) {
			$orders[$key]['shipping_address'] = $order->address.', '.$order->city.', '.$order->state.' '.$order->zip;
		}

		if ($request->input('status_id') != 0) {
			$orders->where('status_id', '=', $request->input('status_id'));
		}

		if ($request->input('payment_status_id') != 0) {
			$orders->where('payment_status_id', '=', $request->input('payment_status_id'));
		}

		if ($request->input('sort') && $request->input('order')) {
			$orders->orderBy($request->input('sort'), $request->input('order'));
		} else {
			$orders->orderby('created_at', 'desc');
		}

		if ($request->input('search')) {
			$orders->where('user.name', 'LIKE', '%'.$request->input('search').'%');
		}

		return $orders->paginate($request->input('per_page'));
	}

}

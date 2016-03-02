<?php

namespace App\Http\Controllers\CMS\Shop;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

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

}

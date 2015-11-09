<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\File;

class DashboardController extends Controller {

	public function index() {
		return view('vendor.grizzdev.cms.dashboard');
	}

	public function data(Request $request, $model) {
		$modelName = "\App\Models\\".ucwords($model);
		$query = $modelName::skip($request->input('skip'))->take($request->input('take'));

		if ($request->input('sort') && $request->input('order')) {
			$query->orderBy($request->input('sort'), $request->input('order'));
		} else {
			$query->orderby('created_at', 'desc');
		}

		if ($request->input('search')) {
			$query->where('name', 'LIKE', '%'.$request->input('search').'%');
		}

		return $query->paginate($request->input('per_page'));
	}

	public function upload(Request $request) {
		$result = [];

		if ($request->hasFile('image') && $request->file('image')->isValid()) {
			$path = '/uploads/'.date('Y').'/'.date('m').'/';

			$file = File::create([
				'path' => $path,
				'name' => $request->file('image')->getClientOriginalName(),
				'mime' => $request->file('image')->getMimeType(),
				'size' => $request->file('image')->getClientSize()
			]);

			$result = [
				'id' => $file->id,
				'path' => $file->path,
				'name' => $file->name,
				'mime' => $file->mime,
				'size' => $file->size
			];

			$request->file('image')->move(public_path().$path, $request->file('image')->getClientOriginalName());
		}

		return json_encode(['image' => $result]);
	}

}

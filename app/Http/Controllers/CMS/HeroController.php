<?php

namespace App\Http\Controllers\CMS;

use Response;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HeroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return \GrizzDev\CMS\Listing::render(new Hero);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return \GrizzDev\CMS\Form::render(new Hero);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request) {
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		return \GrizzDev\CMS\Form::render(Hero::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id) {
		$hero = Hero::find($id);

		if ($request->input('file_id')) {
			$hero->file_id = $request->input('file_id');
		}

		$hero->update([
			'active' => $request->input('active'),
			'address' => $request->input('address'),
			'birth_date' => $request->input('birth_date'),
			'cancer_type' => $request->input('cancer_type'),
			'caringbridge_url' => $request->input('caringbridge_url'),
			'city' => $request->input('city'),
			'description' => $request->input('description'),
			'facebook_url' => $request->input('facebook_url'),
			'funded' => $request->input('funded'),
			'gender' => $request->input('gender'),
			'goal' => $request->input('goal'),
			'hospital_location' => $request->input('hospital_location'),
			'hospital_name' => $request->input('hospital_name'),
			'name' => $request->input('name'),
			'overview' => $request->input('overview'),
			'raised' => $request->input('raised'),
			'shirt_size' => $request->input('shirt_size'),
			'twitter_url' => $request->input('twitter_url'),
			'youtube_url' => $request->input('youtube_url'),
			'zip' => $request->input('zip'),
			'state_id' => $request->input('state_id')
		]);

		$hero->save();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
	}

}

<?php

namespace App\Http\Controllers\CMS;

use Response;
use Illuminate\Http\Request;
use App\Models\Hero;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class HeroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Listing::render(new Hero);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return Form::render(new Hero);
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
		return Form::render(Hero::find($id));
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
			'name' => $request->input('name'),
			'active' => $request->input('active'),
			'funded' => $request->input('funded'),
			'goal' => $request->input('goal'),
			'raised' => $request->input('raised'),
			'birth_date' => $request->input('birth_date'),
			'gender' => $request->input('gender'),
			'email_address' => $request->input('email_address'),
			'phone_number' => $request->input('phone_number'),
			'address' => $request->input('address'),
			'city' => $request->input('city'),
			'state_id' => $request->input('state_id'),
			'zip' => $request->input('zip'),
			'shirt_size' => $request->input('shirt_size'),
			'cancer_type' => $request->input('cancer_type'),
			'facebook_url' => $request->input('facebook_url'),
			'twitter_url' => $request->input('twitter_url'),
			'youtube_url' => $request->input('youtube_url'),
			'caringbridge_url' => $request->input('caringbridge_url'),
			'overview' => $request->input('overview'),
			'description' => $request->input('description'),
			'hospital_name' => $request->input('hospital_name'),
			'hospital_location' => $request->input('hospital_location')
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

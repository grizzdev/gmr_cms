<?php

namespace App\Http\Controllers\CMS;

use Response;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Nomination;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GrizzDev\CMS\Form;
use GrizzDev\CMS\Listing;

class NominationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return Listing::render(new Nomination);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return Form::render(new Nomination);
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
		return Form::render(Nomination::find($id));
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
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
	}

	public function approve($id) {
		$hero = Nomination::find($id)->toHero();
		return Redirect::to('heroes/'.$hero->id);
	}

	public function deny($id) {
		Nomination::destroy($id);
		return Redirect::back();
	}

}

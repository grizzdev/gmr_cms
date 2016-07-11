<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Datatables;
use App\Models\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Kris\LaravelFormBuilder\FormBuilder;
//use App\Transformers\EventFormTransformer;

class EventController extends Controller {

	public function index() {
		return view('cms.events.list', [
			'model' => new Event
		]);
	}

	public function create() {
	}

	public function store() {
	}

	public function event() {
	}

	public function update() {
	}

	/*public function event($id, FormBuilder $formBuilder) {
		$event = Event::find($id);

		$event_transformed = (new EventFormTransformer)->transform($event);

		$form = $formBuilder->create('App\Forms\CMS\EventForm', [
			'method' => 'POST',
			'url' => action('CMS\EventController@postEvent'),
			'model' => $event_transformed,
			'role' => 'form',
			'data-remote' => 'true',
			'data-toggle' => 'validator',
			'data-disable' => 'true'
		]);

		return view('cms.events.event', compact('form', 'event'));
	}*/

	/*public function create(FormBuilder $formBuilder) {
		$form = $formBuilder->create('App\Forms\CMS\EventForm', [
			'method' => 'POST',
			'url' => action('CMS\EventController@postEvent'),
			'role' => 'form',
			'data-remote' => 'true',
			'data-toggle' => 'validator',
			'data-disable' => 'true'
		]);

		return view('cms.events.event', compact('form'));
	}*/

	/*public function postEvent(Request $request) {
		if ($request->input('id')) {
			$event = Event::find($request->input('id'));

			$event->update([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'city' => $request->input('city'),
				'state_id' => $request->input('state_id'),
				'zip' => $request->input('zip'),
				'lead_id' => $request->input('lead_id'),
				'start_at' => Carbon::parse($request->input('start_at')),
				'end_at' => Carbon::parse($request->input('end_at')),
			]);

			$event->save();
		} else {
			$event = Event::create([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'city' => $request->input('city'),
				'state_id' => $request->input('state_id'),
				'zip' => $request->input('zip'),
				'lead_id' => $request->input('lead_id'),
				'start_at' => Carbon::parse($request->input('start_at')),
				'end_at' => Carbon::parse($request->input('end_at')),
			]);
		}

		return response()->json(['redirect' => action('CMS\EventController@event', $event->id)]);
	}*/

	/*public function data() {
		return Datatables::of(Event::query())
			->setTransformer('App\Transformers\EventDataTableTransformer')
			->make(true);
	}*/

}


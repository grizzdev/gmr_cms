<?php

namespace App\Http\Controllers\CMS\Events;

use Illuminate\Http\Request;

use Response;
use Carbon\Carbon;
use Datatables;
use App\Models\Event;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller {

	public function index() {
		return view('cms.events.list', ['events' => Event::all()]);
	}

	public function create() {
		$admins = \App\Models\Role::with('users')->where('name', 'admin')->get();

		return view('cms.events.create', [
			'event' => new Event,
			'states' => ['' => ''] + \App\Models\State::where('country_id', '=', 224)->lists('name', 'id')->toArray(),
			'users' => ['' => ''] + $admins[0]->users->lists('name', 'id')->toArray()
		]);
	}

	public function store(Request $request) {
		$event = Event::create([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			'venue' => $request->input('venue'),
			'address' => $request->input('address'),
			'city' => $request->input('city'),
			'state_id' => $request->input('state_id'),
			'zip' => $request->input('zip'),
			'lead_id' => $request->input('lead_id'),
			'start_at' => date('Y-m-d h:i:s', strtotime($request->input('start_at'))),
			'end_at' => date('Y-m-d h:i:s', strtotime($request->input('end_at')))
		]);

		return Response::json(['href' => url('event/'.$event->id)]);
	}

	public function event($id) {
		$event = Event::find($id);

		if ($event) {
			$admins = \App\Models\Role::with('users')->where('name', 'admin')->get();

			return view('cms.events.event', [
				'event' => $event,
				'states' => ['' => ''] + \App\Models\State::where('country_id', '=', 224)->lists('name', 'id')->toArray(),
				'users' => ['' => ''] + $admins[0]->users->lists('name', 'id')->toArray()
			]);
		} else {
			return redirect()->back();
		}
	}

	public function update(Request $request, $id) {
		$event = Event::find($id);

		if ($event) {
			$event->update([
				'title' => $request->input('title'),
				'description' => $request->input('description'),
				'venue' => $request->input('venue'),
				'address' => $request->input('address'),
				'city' => $request->input('city'),
				'state_id' => $request->input('state_id'),
				'zip' => $request->input('zip'),
				'lead_id' => $request->input('lead_id'),
				'start_at' => date('Y-m-d h:i:s', strtotime($request->input('start_at'))),
				'end_at' => date('Y-m-d h:i:s', strtotime($request->input('end_at')))
			]);

			return Response::json(['href' => url('event/'.$event->id)]);
		} else {
			return Response::json(['href' => url('events')]);
		}
	}

}


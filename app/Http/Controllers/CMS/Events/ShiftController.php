<?php

namespace App\Http\Controllers\CMS\Events;

use Illuminate\Http\Request;

use Response;
use Carbon\Carbon;
use Datatables;
use App\Models\User;
use App\Models\Event;
use App\Models\EventJob as Job;
use App\Models\EventShift as Shift;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShiftController extends Controller {

	public function create($event_id) {
		$event = Event::find($event_id);

		if ($event) {
			return view('cms.events.shifts.create', [
				'shift' => new Shift,
				'jobs' => ['' => ''] + Job::where('event_id', '=', $event->id)->lists('title', 'id')->toArray(),
				'event' => $event
			]);
		} else {
			return redirect()->back();
		}
	}

	public function store(Request $request, $event_id) {
		Shift::create([
			'event_job_id' => $request->input('event_job_id'),
			'start_at' => date('Y-m-d H:i:s', strtotime($request->input('start_at'))),
			'end_at' => date('Y-m-d H:i:s', strtotime($request->input('end_at')))
		]);

		return Response::json(['href' => url('event/'.$event_id)]);
	}

	public function shift($event_id, $id) {
		$event = Event::find($event_id);
		$shift = Shift::find($id);

		if ($shift) {
			return view('cms.events.shifts.shift', [
				'shift' => $shift,
				'jobs' => ['' => ''] + Job::where('event_id', '=', $event->id)->lists('title', 'id')->toArray(),
				'event' => $event,
				'users' => ['' => ''] + User::orderBy('name')->lists('name', 'id')->toArray()
			]);
		} else {
			return redirect()->back();
		}
	}

	public function update(Request $request, $event_id, $id) {
		$shift = Shift::find($id);

		if ($shift) {
			$shift->update([
				'event_job_id' => $request->input('event_job_id'),
				'start_at' => date('Y-m-d H:i:s', strtotime($request->input('start_at'))),
				'end_at' => date('Y-m-d H:i:s', strtotime($request->input('end_at'))),
				'user_id' => $request->input('user_id')
			]);
		}

		return Response::json(['href' => url('event/'.$event_id)]);
	}

}

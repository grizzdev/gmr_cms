<?php

namespace App\Http\Controllers\CMS\Events;

use Illuminate\Http\Request;

use Response;
use Carbon\Carbon;
use Datatables;
use App\Models\Event;
use App\Models\EventJob as Job;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class JobController extends Controller {

	public function create($event_id) {
		$event = Event::find($event_id);

		if ($event) {
			return view('cms.events.jobs.create', [
				'job' => new Job,
				'event' => $event
			]);
		} else {
			return redirect()->back();
		}
	}

	public function store(Request $request, $event_id) {
		Job::create([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			'event_id' => $request->input('event_id')
		]);

		return Response::json(['href' => url('event/'.$event_id)]);
	}

	public function job($event_id, $id) {
		$job = Job::find($id);

		if ($job) {
			return view('cms.events.jobs.job', [
				'job' => $job
			]);
		} else {
			return redirect()->back();
		}
	}

	public function update(Request $request, $event_id, $id) {
		$job = Job::find($id);

		if ($job) {
			$job->update([
				'title' => $request->input('title'),
				'description' => $request->input('description')
			]);
		}

		return Response::json(['href' => url('event/'.$event_id)]);
	}

}


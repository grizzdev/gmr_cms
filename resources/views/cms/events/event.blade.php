@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($event, ['data-remote' => true, 'method' => ($event->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit Event: {!! $event->title !!}
		</div>
		<div class="panel-body">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#event" aria-controls="home" role="tab" data-toggle="tab">Event</a></li>
				<li role="presentation"><a href="#jobs" aria-controls="jobs" role="tab" data-toggle="tab">Jobs</a></li>
				<li role="presentation"><a href="#shifts" aria-controls="shifts" role="tab" data-toggle="tab">Shifts</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="event">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							{!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('title', $event->title, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('slug', $event->slug, ['class' => 'form-control', 'required', 'disabled']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							{!! Form::label('lead_id', 'Event Lead', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::select('lead_id', $users, $event->lead_id, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							{!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::textarea('description', $event->description, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							{!! Form::label('venue', 'Venue', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('venue', $event->venue, ['class' => 'form-control']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							{!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('address', $event->address, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4">
							{!! Form::label('city', 'City', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('city', $event->city, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							{!! Form::label('state_id', 'State', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::select('state_id', $states, $event->state_id, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							{!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								{!! Form::text('zip', $event->zip, ['class' => 'form-control', 'required']) !!}
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							{!! Form::label('start_at', 'Starts', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								<input type="datetime-local" name="start_at" id="start_at" value="{!! $event->start_at->format('Y-m-d\TH:i') !!}" class="form-control" required />
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
						<div class="col-sm-12 col-md-6">
							{!! Form::label('end_at', 'Ends', ['class' => 'control-label']) !!}
							<div class="form-group has-feedback">
								<input type="datetime-local" name="end_at" id="end_at" value="{!! $event->end_at->format('Y-m-d\TH:i') !!}" class="form-control" required />
								<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="jobs">
					<div class="row">
						<div class="col-sm-12">
							<br />
							<div id="table-toolbar">
								<a href="/event/{!! $event->id !!}/job/create" class="btn btn-default" title="New Job"><i class="fa fa-plus"></i></a>
							</div>
							<br />
							<div class="table-responsive">
								<table id="table" class="table table-bordered table-striped">
									<thead>
										<th></th>
										<th>Title</th>
									</thead>
									<tbody>
									@foreach($event->jobs as $job)
										<tr>
											<td><a href="/event/{!! $event->id !!}/job/{!! $job->id !!}"><i class="glyphicon glyphicon-eye-open"></i></a></td>
											<td>{!! $job->title !!}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="shifts">
					<div class="row">
						<div class="col-sm-12">
							<br />
							<div id="table-toolbar">
								<a href="/event/{!! $event->id !!}/shift/create" class="btn btn-default" title="New Shift"><i class="fa fa-plus"></i></a>
							</div>
							<br />
							<div class="table-responsive">
								<table id="table" class="table table-bordered table-striped">
									<thead>
										<th></th>
										<th>Job</th>
										<th>Start</th>
										<th>End</th>
									</thead>
									<tbody>
									@foreach($event->shifts as $shift)
										<tr>
											<td><a href="/event/{!! $event->id !!}/shift/{!! $shift->id !!}"><i class="glyphicon glyphicon-eye-open"></i></a></td>
											<td>{!! $shift->job->title !!}</td>
											<td>{!! $shift->start_at->format('m/d/Y, h:i A') !!}</td>
											<td>{!! $shift->end_at->format('m/d/Y, h:i A') !!}</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			@if(!empty($buttons))
				@foreach($buttons as $button)
				{!! $button !!}
				@endforeach
			@else
				<span class="pull-left">
					{!! Form::submit('Save', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving...']) !!}
				</span>
				<div class="clearfix">
			@endif
		</div>
	</div>
{!! Form::close() !!}
@endsection

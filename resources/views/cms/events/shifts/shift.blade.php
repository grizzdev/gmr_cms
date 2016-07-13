@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
<a href="/event/{!! $event->id !!}">Back to: {!! $event->title !!}</a>
<br />
<br />
{!! Form::model($shift, ['data-remote' => true, 'method' => ($shift->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<input type="hidden" name="event_id" value="{!! $event->id !!}" />
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit Shift
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					{!! Form::label('event_job_id', 'Job', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::select('event_job_id', $jobs, null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					{!! Form::label('user_id', 'Volunteer', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::select('user_id', $users, $shift->user_id, ['class' => 'form-control']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					{!! Form::label('start_at', 'Starts', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						<input type="datetime-local" name="start_at" id="start_at" value="{!! $shift->start_at->format('Y-m-d\TH:i') !!}" class="form-control" required />
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					{!! Form::label('end_at', 'Ends', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						<input type="datetime-local" name="end_at" id="end_at" value="{!! $shift->end_at->format('Y-m-d\TH:i') !!}" class="form-control" required />
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<span class="pull-left">
				{!! Form::submit('Save', ['class' => 'btn btn-primary', 'data-disable-with' => 'Saving...']) !!}
			</span>
			<div class="clearfix">
		</div>
	</div>
{!! Form::close() !!}
@endsection

@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($event, ['data-remote' => true, 'method' => ($event->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			New Event
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					{!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					{!! Form::label('slug', 'Slug', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('slug', null, ['class' => 'form-control', 'required', 'disabled']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					{!! Form::label('lead_id', 'Event Lead', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::select('lead_id', $users, null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					{!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					{!! Form::label('venue', 'Venue', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('venue', null, ['class' => 'form-control']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					{!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('address', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					{!! Form::label('city', 'City', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('city', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					{!! Form::label('state_id', 'State', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::select('state_id', $states, null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					{!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('zip', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					{!! Form::label('start_at', 'Starts', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						<input type="datetime-local" name="start_at" id="start_at" value="" class="form-control" required />
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					{!! Form::label('end_at', 'Ends', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						<input type="datetime-local" name="end_at" id="end_at" value="" class="form-control" required />
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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

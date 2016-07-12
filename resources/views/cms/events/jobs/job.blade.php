@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
<a href="/event/{!! $job->event->id !!}">Back to: {!! $job->event->title !!}</a>
<br />
<br />
{!! Form::model($job, ['data-remote' => true, 'method' => ($job->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<input type="hidden" name="event_id" value="{!! $job->event->id !!}" />
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit {!! $job->title !!}
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">
					{!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('title', $job->title, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					{!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::textarea('description', $job->description, ['class' => 'form-control', 'required']) !!}
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

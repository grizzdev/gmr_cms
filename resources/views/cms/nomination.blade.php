@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
<div class="panel panel-default">
	<div class="panel-heading">
		Nomination: {{ $nomination->name }}
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Name', ['class' => 'control-label']) !!}
				<p>{{ $nomination->name }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Email', ['class' => 'control-label']) !!}
				<p>{{ $nomination->email_address }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Phone', ['class' => 'control-label']) !!}
				<p>{{ $nomination->phone_number }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Birth Date', ['class' => 'control-label']) !!}
				<p>{{ $nomination->birth_date }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Gender', ['class' => 'control-label']) !!}
				<p>{{ ($nomination->gender == 'f') ? 'Female' : 'Male' }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Shirt Size', ['class' => 'control-label']) !!}
				<p>{{ strtoupper($nomination->shirt_size) }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Cancer Type', ['class' => 'control-label']) !!}
				<p>{{ $nomination->cancer_type }}</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Address', ['class' => 'control-label']) !!}
				<p>
					{{ $nomination->address }}<br />
					{{ $nomination->city }}, {{ $nomination->state->code }} {{ $nomination->zip }}<br />
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Hospital', ['class' => 'control-label']) !!}
				<p>
					{{ $nomination->hospital_name }}<br />
					{{ $nomination->hopsital_location }}
				</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Nominee', ['class' => 'control-label']) !!}
				<p>{{ $nomination->nominee->name }} ({{ $nomination->relationship }})</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Facebook URL', ['class' => 'control-label']) !!}
				<p><a href="{{ $nomination->facebook_url }}" target="_blank">{{ $nomination->facebook_url }}</a>&nbsp;</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Twitter URL', ['class' => 'control-label']) !!}
				<p><a href="{{ $nomination->twitter_url }}" target="_blank">{{ $nomination->twitter_url }}</a>&nbsp;</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'Youtube URL', ['class' => 'control-label']) !!}
				<p><a href="{{ $nomination->youtube_url }}" target="_blank">{{ $nomination->youtube_url }}</a>&nbsp;</p>
			</div>
			<div class="col-xs-6 col-md-3">
				{!! Form::label(null, 'CaringBridge URL', ['class' => 'control-label']) !!}
				<p><a href="{{ $nomination->caringbridge_url }}" target="_blank">{{ $nomination->caringbridge_url }}</a>&nbsp;</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				{!! Form::label(null, 'Overview', ['class' => 'control-label']) !!}
				<p>{{ nl2br($nomination->overview) }}</p>
			</div>
			<div class="col-xs-12 col-md-6">
				{!! Form::label(null, 'Image', ['class' => 'control-label']) !!}
				<img src="http://gamerosity.com/{{ $nomination->image->path }}{{ $nomination->image->name }}" class="img img-responsive" style="max-height:440px;" />
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<a href="{{ url('nominations/'.$nomination->id.'/approve') }}" title="Approve" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Approve</a>
		<a href="{{ url('nominations/'.$nomination->id.'/deny') }}" title="Deny" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Decline</a>
	</div>
</div>
@endsection

@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::open(['url' => '/shop/reports/orders', 'class' => 'form-inline']) !!}
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				{!! Form::label('user_name', 'User', ['class' => 'control-label']) !!}
				{!! Form::text('user_name', $request->input('user_name'), ['class' => 'form-control typeahead', 'autocomplete' => 'off', 'data-url' => '/user/json']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('start_at', 'From', ['class' => 'control-label']) !!}
				{!! Form::date('start_at', $request->input('start_at'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('end_at', 'To', ['class' => 'control-label']) !!}
				{!! Form::date('end_at', $request->input('end_at'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Create Report', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	</div>
{!! Form::close() !!}
<hr />
@if(!empty($users))
	@foreach($users as $user)
		<h4>{{ $user->name }} <small>{{ $user->email }}</small></h4>
		@if($user->orders->count())
			@include('cms.users.orders', ['user' => $user, 'start_at' => $request->input('start_at'), 'end_at' => $request->input('end_at')])
		@else
			<h5>No Orders Found</h5>
		@endif
		<hr />
	@endforeach
@endif
@endsection

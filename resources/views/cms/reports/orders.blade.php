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
	@elseif(!empty($orders))
	<div id="table-toolbar"></div>
	<div class="table-responsive">
		<table
			class="table"
			data-toggle="table"
			data-pagination="false"
			data-striped="true"
			data-show-refresh="false"
			data-show-columns="false"
			data-show-export="true"
			data-search="false"
			data-mobile-responsive="true"
			data-check-on-init="false"
			data-columns-hidden=[]
			data-toolbar="#table-toolbar"
			data-reorderable-columns="false"
			data-toolbar="#table-toolbar"
			data-undefined-text=""
			data-filter-control="false"
		>
			<thead>
				<tr>
					<th>#</th>
					<th>Customer</th>
					<th>Shipping Address</th>
					<th>Billing Address</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ $order->user->name }}</td>
					<td>{{ $order->shipping_address->address_1 }}, {{ $order->shipping_address->city }}, {{ $order->shipping_address->state->name }} {{ $order->shipping_address->zip }}</td>
					<td>{{ $order->billing_address->address_1 }}, {{ $order->billing_address->city }}, {{ $order->billing_address->state->name }} {{ $order->billing_address->zip }}</td>
					<td>{{ $order->created_at->format('m/d/y g:i a') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
@endsection

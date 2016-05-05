@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::open(['url' => '/shop/reports/products', 'class' => 'form-inline']) !!}
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				{!! Form::label('product_id', 'Product', ['class' => 'control-label']) !!}
				{!! Form::select('product_id', $products, $request->input('product_id'), ['class' => 'form-control', 'autocomplete' => 'off']) !!}
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
<div class="row">
	<div class="col-xs-12">
@if(!empty($orders))
	<?php $grand_total = 0; ?>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>User</th>
						<th>Date</th>
						<th>$</th>
					</tr>
				</thead>
				<tbody>
				@foreach($orders as $order)
					<?php $order_total = 0; ?>
					<tr>
						<td><a href="{{ url('shop/orders/'.$order->id)}}">{{ $order->id }}</a></td>
						<td><a href="{{ url('site/users/'.$order->user->id) }}">{{ $order->user->name }}</a></td>
						<td>{{ $order->created_at->format('n/j/y') }}</td>
						<td>
						@foreach($order->cart->items as $item)
							@if($item->product_id == $request->input('product_id'))
							<?php
								$order_total += $item->price();
								$grand_total += $item->price();
							?>
							@endif
						@endforeach
							${{ number_format($order_total, 2, '.', ',') }}
						</td>
					</tr>
				@endforeach
				</tbody>
				<tfoot>
					<th>Total Orders</th>
					<th>{{ $orders->count() }}</th>
					<th>Total Sales</th>
					<th>${{ number_format($grand_total, 2, '.', ',') }}</th>
				</tfoot>
			</table>
		</div>
@elseif($request->input('product_id'))
	<h5>No Orders Found</h5>
@endif
	</div>
</div>
@endsection

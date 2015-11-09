@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($order, ['data-remote' => true, 'method' => ($order->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<input type="hidden" name="id" value="{!! $order->id !!}" />
	<div class="panel panel-default">
		<div class="panel-heading">
		@if($order->id)
			Edit Order #{!! $order->id !!}
		@else
			New Order
		@endif
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-sm-3">
					{!! Form::label('created_at', 'Created') !!}
					<br />
					{!! date('m/d/Y g:i a', strtotime($order->created_at)) !!}
				</div>
				<div class="col-xs-12 col-sm-3">
					{!! Form::label('updated_at', 'Updated') !!}
					<br />
					{!! date('m/d/Y g:i a', strtotime($order->updated_at)) !!}
				</div>
				<div class="col-xs-12 col-sm-3">
					{!! Form::label('status_id', 'Status') !!}
					{!! Form::select('order[status_id]', [1 => 'Pending', 2 => 'Processing', 4 => 'On-Hold', 5 => 'Cancelled', 3 => 'Completed'], $order->status_id, ['class' => 'form-control']) !!}
				</div>
				<div class="col-xs-12 col-sm-3">
					<div class="form-group">
						{!! Form::label('payment_status_id', 'Payment Status') !!}
						{!! Form::select('order[payment_status_id]', [1 => 'Pending', 6 => 'Refunded', 7 => 'Charged', 8 => 'Declined'], $order->payment_status_id, ['class' => 'form-control']) !!}
					</div>
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-xs-12 col-sm-4">
					Name: {!! $order->user->name !!} <br />
					Email: {!! $order->user->email !!} <br />
					Phone: {!! $order->user->phone !!}<br />
					Notes: {!! $order->notes !!}
				</div>
				<div class="col-xs-12 col-sm-4">
					Billing Address: <small><a href="{!! url('shop/addresses/'.$order->billing_address->id) !!}"><!--[edit]--></a></small><br />
					{!! $order->billing_address->address_1 !!}<br />
					{!! $order->billing_address->city !!}, {!! $order->billing_address->state->code !!} {!! $order->billing_address->zip !!}<br />
					{!! $order->billing_address->country->code !!}
				</div>
				<div class="col-xs-12 col-sm-4">
					Shipping Address: <small><a href="{!! url('shop/addresses/'.$order->billing_address->id) !!}"><!--[edit]--></a></small><br />
					{!! $order->shipping_address->address_1 !!}<br />
					{!! $order->shipping_address->city !!}, {!! $order->shipping_address->state->code !!} {!! $order->shipping_address->zip !!}<br />
					{!! $order->shipping_address->country->code !!}
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Item</th>
							<th>Options</th>
							<th>Qty</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					@if($order->cart->items->count())
						@foreach($order->cart->items as $item)
						<tr>
							<td>{!! $item->product->name !!}</td>
							<td>
								@if(!empty($item->hero_id))
								<b>Hero:</b> {!! $item->hero->name !!}<br />
								@endif
								@foreach($item->itemAttributes as $attr)
									<b>{!! $attr->attribute->name !!}:</b>
									@if($attr->attribute->name == 'Amount')
									${!! $attr->value !!}<br />
									@else
									{!! \App\Models\Attribute::find($attr->value)->name !!}<br />
									@endif
								@endforeach
							</td>
							<td>{!! $item->quantity !!}</td>
							<td>
							@if($item->product->id != 1)
								{!! Form::select('items['.$item->id.'][status_id]', [
									9 => 'Not Shipped',
									10 => 'Shipped',
									11 => 'To Print',
									12 => 'On Order',
									13 => 'Out for Embroidering/Sewing',
								], $item->status_id, ['class' => 'form-control']) !!}
							@endif
							</td>
						</tr>
						@endforeach
					@endif
					</tbody>
				</table>
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
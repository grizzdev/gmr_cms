<?php
$total = 0;
$contribution = 0;
?>
@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($user, ['data-remote' => true, 'method' => ($user->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			User: {!! $user->name !!}
		</div>
		<div class="panel-body">
			<div class="row">
				@foreach($user->getFormConfig() as $field => $data)
					@include('vendor.grizzdev.cms.fields.'.$data['type'], ['model' => $user, 'field' => $field, 'data' => $data])
				@endforeach
			</div>
			<div class="row">
				<div class="col-xs-12">
					<hr />
					@if($user->orders->count())
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Date</th>
									<th>Status</th>
									<th>Items</th>
									<th>Total</th>
									<th>Contribution</th>
								</tr>
							</thead>
							<tbody>
							@foreach($user->orders as $order)
								<?php $total += $order->cart->total() ?>
								<?php $contribution += $order->cart->contribution() ?>
								<tr>
									<td>
										<a href="{{ url('shop/orders/'.$order->id)}}">{{ $order->id }}</a>
									</td>
									<td>
										{{ $order->created_at }}
									</td>
									<td>
										{{ $order->status->name }}
									</td>
									<td>
										{{ $order->cart->items->count() }}
									</td>
									<td>
										${{ number_format($order->cart->total(), 2, '.', ',') }}
									</td>
									<td>
										${{ number_format($order->cart->contribution(), 2, '.', ',') }}
									</td>
								</tr>
							@endforeach
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4"></td>
									<td>
										${{ number_format($total, 2, '.', '') }}
									</td>
									<td>
										${{ number_format($contribution, 2, '.', '') }}
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					@endif
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
				<a href="{{ url(preg_replace('/[0-9]+|create$/', '', Request::url())) }}" class="btn btn-default">Cancel</a>
			</span>
			@if($user->id)
			<span class="pull-right">
				<a href="#" class="btn btn-danger" data-remote="true" data-confirm="Do you want to PERMANENTLY delete this?" data-method="delete" data-disable-with="Deleting..." rel="nofollow">Delete</a>
			</span>
			@endif
			<div class="clearfix">
		@endif
		</div>
	</div>
{!! Form::close() !!}
@endsection

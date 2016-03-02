<?php
$total = $contribution = 0;

$orders = $user->orders()->orderBy('created_at', 'desc');

if (!empty($start_at)) {
	$orders = $orders->where('created_at', '>', $start_at);
}

if (!empty($end_at)) {
	$orders = $orders->where('created_at', '<', $end_at);
}

$orders = $orders->get();
?>
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
				@foreach($orders as $order)
					<?php $total += $order->cart->total() ?>
					<?php $contribution += $order->cart->contribution() ?>
					<tr>
						<td>
							<a href="{{ url('shop/orders/'.$order->id)}}">{{ $order->id }}</a>
						</td>
						<td>
							{{ $order->created_at->format('n/j/y') }}
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

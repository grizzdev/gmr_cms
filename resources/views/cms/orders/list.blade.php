@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<div id="table-toolbar">
	<div class="form-inline" role="form">
		{!! Form::select('status_id', [0 => 'Status', 1 => 'Pending', 2 => 'Processing', 4 => 'On-Hold', 5 => 'Cancelled', 3 => 'Completed'], null, ['class' => 'form-control']) !!}
		{!! Form::select('payment_status_id', [0 => 'Payment Status', 1 => 'Pending', 6 => 'Refunded', 7 => 'Charged', 8 => 'Declined'], null, ['class' => 'form-control']) !!}
		{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
		{!! Form::submit('Go', ['class' => 'btn btn-default', 'id' => 'btn-filter']) !!}
	</div>
</div>
<div class="table-responsive">
	<table
		id="table"
		class="table"
		data-toggle="table"
		data-side-pagination="server"
		data-pagination="true"
		data-url="/orders/data"
		data-striped="true"
		data-page-size="24"
		data-page-list="[12, 24, 48, 96]"
		data-show-refresh="true"
		data-show-columns="true"
		data-show-export="true"
		data-search="false"
		data-mobile-responsive="true"
		data-check-on-init="true"
		data-columns-hidden=[]
		data-id-field="id"
		data-toolbar="#table-toolbar"
		data-reorderable-columns="true"
		data-method="post"
		data-query-params-type="laravel"
		data-toolbar="#table-toolbar"
		data-undefined-text=""
		data-filter-control="true"
		data-query-params="queryParams"
	>
		<thead>
			<tr>
				@foreach($model->getListConfig() as $field => $data)
				<th
					data-field="{{ $field }}"
					data-sortable="{{ $data['sortable'] }}"
					data-switchable="{{ $data['switchable'] }}"
					@if($data['format']) data-formatter="{{ $data['format'] }}" @endif
				>{!! $data['label'] !!}</th>
				@endforeach
			</tr>
		</thead>
	</table>
</div>
<script>
</script>
@endsection

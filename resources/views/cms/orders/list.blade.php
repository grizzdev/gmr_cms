@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<div id="table-toolbar">
</div>
<div class="table-responsive">
	<table
		class="table"
		data-toggle="table"
		data-side-pagination="server"
		data-pagination="true"
		data-url="/cms/orders/data"
		data-striped="true"
		data-page-size="24"
		data-page-list="[12, 24, 48, 96]"
		data-show-refresh="true"
		data-show-columns="true"
		data-show-export="true"
		data-search="true"
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
@endsection

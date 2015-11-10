<?php
$modelName = strtolower(preg_replace('/App\\\\Models\\\\/', '', get_class($model)));
$hiddenCols = [];
foreach ($model->getListConfig() as $field => $data) {
	if (!$data['mobile']) {
		$hiddenCols[] = "'$field'";
	}
}
?>
@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<div id="table-toolbar">
	@if(!in_array($modelName, ['order','nomination','hero']))
	<a href="create" class="btn btn-default" title="New {!! ucwords($modelName) !!}"><i class="fa fa-plus"></i></a>
	@endif
</div>
<div class="table-responsive">
	<table
		class="table"
		data-toggle="table"
		data-side-pagination="server"
		data-pagination="true"
		data-url="/{!! $modelName !!}/data"
		data-striped="true"
		data-page-size="24"
		data-page-list="[12, 24, 48, 96]"
		data-show-refresh="true"
		data-show-columns="true"
		data-show-export="true"
		data-search="true"
		data-mobile-responsive="true"
		data-check-on-init="true"
		data-columns-hidden=[{!! implode(',', $hiddenCols) !!}]
		data-id-field="id"
		data-toolbar="#table-toolbar"
		data-reorderable-columns="true"
		data-method="post"
		data-query-params-type="laravel"
		data-toolbar="#table-toolbar"
		data-undefined-text=""
		data-filter-control="true"
		data-advanced-search="true"
	>
		<thead>
			<tr>
				@foreach($model->getListConfig() as $field => $data)
				<th
					data-field="{!! $field !!}"
					data-sortable="{!! $data['sortable'] !!}"
					data-switchable="{!! $data['switchable'] !!}"
					@if($data['format']) data-formatter="{!! $data['format'] !!}" @endif
				>{!! $data['label'] !!}</th>
				@endforeach
			</tr>
		</thead>
	</table>
</div>
@endsection

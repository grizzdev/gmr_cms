<?php
$modelName = preg_replace('/App\\\\Models\\\\/', '', get_class($model));
?>
@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($model, ['data-remote' => true, 'method' => ($model->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			@if($model->id)
				Edit {!! $modelName !!}
			@else
				New {!! $modelName !!}
			@endif
		</div>
		<div class="panel-body">
			@foreach($model->getFormConfig() as $field => $data)
				@include('vendor.grizzdev.cms.fields.'.$data['type'], ['model' => $model, 'field' => $field, 'data' => $data])
			@endforeach
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
				@if($model->id)
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

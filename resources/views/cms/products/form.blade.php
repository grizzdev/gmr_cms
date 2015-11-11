@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
{!! Form::model($product, ['data-remote' => true, 'method' => ($product->id) ? 'put' : 'post', 'files' => true, 'class' => 'model-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
	<input type="hidden" name="id" value="{!! $product->id !!}" />
	<div class="panel panel-default">
		<div class="panel-heading">
		@if($product->id)
			Edit Product {!! $product->name !!}
		@else
			New Product
		@endif
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					{!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
					<div class="form-group has-feedback">
						{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					{!! Form::label('sku', 'SKU', ['class' => 'control-label']) !!}
					{!! Form::text('sku', null, ['class' => 'form-control', 'disabled']) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
						<div class="input-group">
							<div class="input-group-addon">$</div>
							{!! Form::text('price', null, ['class' => 'form-control', 'pattern' => '^\d*\.?\d{1,2}?$', 'required']) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('sale_price', 'Sale Price', ['class' => 'control-label']) !!}
						<div class="input-group">
							<div class="input-group-addon">$</div>
							{!! Form::text('sale_price', null, ['class' => 'form-control', 'pattern' => '^\d*\.?\d{1,2}?$']) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('cost', 'Cost', ['class' => 'control-label']) !!}
						<div class="input-group">
							<div class="input-group-addon">$</div>
							{!! Form::text('cost', null, ['class' => 'form-control', 'pattern' => '^\d*\.?\d{1,2}?$', 'required']) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('contribution_amount', 'Contribution', ['class' => 'control-label']) !!}
						<div class="input-group">
							<div class="input-group-addon">$</div>
							{!! Form::text('contribution_amount', null, ['class' => 'form-control', 'pattern' => '^\d*\.?\d{1,2}?$', 'required']) !!}
							<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
						{!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group has-feedback">
						{!! Form::label('short_description', 'Short Description', ['class' => 'control-label']) !!}
						{!! Form::textarea('short_description', null, ['class' => 'form-control', 'required']) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					{!! Form::label('active', 'Active', ['class' => 'control-label']) !!}
					{!! Form::select('active', [0 => 'No', 1 => 'Yes'], null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<hr />
					<h5>Attributes</h5>
					@foreach($product->attributes as $attribute)
						<?php $attrs = [] ?>
						@if(!$attribute->parent_id && $attribute->id != 39 && $attribute->type == 'select')
						{!! Form::label($attribute->name) !!}
						@foreach($product->attributes as $attr)
							@if($attr->parent_id == $attribute->id)
								<?php $attrs[] = $attr->id ?>
							@endif
						@endforeach
						{!! Form::select('attribute['.$attribute->id.'][]', \App\Models\Attribute::where('parent_id', '=', $attribute->id)->lists('name', 'id'), $attrs, ['class' => 'form-control', 'multiple']) !!}
						@endif
					@endforeach
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
				</span>
				<div class="clearfix">
			@endif
		</div>
	</div>
{!! Form::close() !!}
@endsection

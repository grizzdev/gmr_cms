<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::select($field, \App\Models\Location::where('parent_id', '=', 224)->lists('name', 'id'), null, ['class' => 'form-control', $data['required'] ? 'required' : '', $data['disabled'] ? 'disabled' : '']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>

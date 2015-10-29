<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::select($field, [0 => ''] + $data['model']::lists($data['field'], 'id')->toArray(), null, ['class' => 'form-control', $data['required'], $data['disabled']]) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>

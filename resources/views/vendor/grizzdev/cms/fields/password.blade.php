<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::$data['type']($field, ['class' => 'form-control', $data['required'] ? 'required' : '', $data['disabled'] ? 'disabled' : '']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>
@if($data['confirmed'])
<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field.'_confirmation', $data['label'].' Confirmation', ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::$data['type']($field.'_confirmation', ['class' => 'form-control', 'data-match' => "#$field", $data['required'] ? 'required' : '', $data['disabled'] ? 'disabled' : '']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>
@endif

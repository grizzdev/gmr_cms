<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			<div class="input-group-addon">$</div>
			{!! Form::text($field, null, [
				'class' => 'form-control',
				'pattern' => '^\d*\.?\d{1,2}?$',
				$data['required'] ? 'required' : '',
				$data['disabled'] ? 'disabled' : ''
			]) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>

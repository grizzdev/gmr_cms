<?
if (!empty($data['multiple'])) {
	$options = $data['model']::lists($data['field'], 'id')->toArray();
	$value = json_decode($model->$field);
	$field_name = $field.'[]';
} else {
	$options = [0 => ''] + $data['model']::lists($data['field'], 'id')->toArray();
	$value = $model->$field;
	$field_name = $field;
}
?>
<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			{!! Form::select($field_name, $options, $value, ['class' => 'form-control', $data['required'] ? 'required' : '', $data['disabled'] ? 'disabled' : '', !empty($data['multiple']) ? 'multiple' : '']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>

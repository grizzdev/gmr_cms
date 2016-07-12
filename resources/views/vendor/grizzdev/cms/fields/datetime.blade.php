<?
if ($model->$field) {
	$value = date('Y-m-d h:i:s', strtotime($model->$field));
} else {
	$value = null;
}
?>
<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			<input type="datetime" name="{!! $field !!}" id="{!! $field !!}" class="form-control" />
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-6">
	<div class="form-group {!! ($data['required']) ? 'has-feedback' : '' !!}">
		{!! Form::label($field, $data['label'], ['class' => 'control-label']) !!}
		<div class="input-group">
			<span class="btn btn-primary fileinput-button">
				<i class="glyphicon glyphicon-plus"></i>
				<span>Add Image</span>
				{!! Form::file('image', ['data-url' => '/cms/upload']) !!}
			</span>
			<span id="file_name"></span>
			{!! Form::hidden('file_id') !!}
		</div>
	</div>
</div>

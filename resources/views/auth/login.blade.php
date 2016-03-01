@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<div class="pt-50">
	{!! Form::open(['url' => '/auth/login', 'data-remote' => true, 'method' => 'post', 'files' => false, 'class' => 'login-form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<div class="form-group has-feedback">
					{!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<div class="form-group has-feedback">
					{!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
					<div class="input-group">
						{!! Form::password('password', ['class' => 'form-control', 'required' => true]) !!}
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-3 col-sm-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('remember') !!}
						<b>Remember Me</b>
					</label>
				</div>
			</div>
			<div class="col-xs-6 col-sm-3 text-right">
				{!! Form::submit('Login', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>
@endsection

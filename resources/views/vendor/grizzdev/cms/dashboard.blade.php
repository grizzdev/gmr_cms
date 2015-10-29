@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<div class="dashboard-content">
	<!--<h1 class="page-header">Dashboard</h1>-->
	<br />
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-bolt fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="panel-heading-number">{!! \App\Models\Nomination::all()->count() !!}</div>
							<div class="panel-heading-text">New Nominations!</div>
						</div>
					</div>
				</div>
				<a href="{!! url('nominations') !!}">
					<div class="panel-footer">
						<span class="pull-left">View</span>
						<span class="pull-right"><i class="glyphicon glyphicon-menu-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-lg-3">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-shopping-cart fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="panel-heading-number">{!! \App\Models\Order::where('status_id', '=', 1)->count() !!}</div>
							<div class="panel-heading-text">New Orders!</div>
						</div>
					</div>
				</div>
				<a href="{!! url('shop/orders') !!}">
					<div class="panel-footer">
						<span class="pull-left">View</span>
						<span class="pull-right"><i class="glyphicon glyphicon-menu-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<!--
		<div class="col-xs-12 col-sm-6 col-lg-3">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-bolt fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="panel-heading-number">XX</div>
							<div class="panel-heading-text">New Nominations!</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">View</span>
						<span class="pull-right"><i class="glyphicon glyphicon-menu-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-lg-3">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-bolt fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="panel-heading-number">XX</div>
							<div class="panel-heading-text">New Nominations!</div>
						</div>
					</div>
				</div>
				<a href="#">
					<div class="panel-footer">
						<span class="pull-left">View</span>
						<span class="pull-right"><i class="glyphicon glyphicon-menu-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		-->
	</div>
	<!--
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-money"></i> Orders
				</div>
				<div class="panel-body">
				</div>
				<div class="panel-footer text-right">
					<a href="{{ url('shop/orders') }}">View All Orders <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-list"></i> Logs
				</div>
				<div class="panel-body">
				</div>
				<div class="panel-footer text-right">
					<a href="{{ url('logs') }}">View All Logs <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</div>
	-->
</div>
@endsection

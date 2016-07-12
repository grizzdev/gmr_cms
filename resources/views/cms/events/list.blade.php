@extends('vendor.grizzdev.cms.layouts.cms')

@section('content')
<br />
<div id="table-toolbar">
	<a href="/event/create" class="btn btn-default" title="New Event"><i class="fa fa-plus"></i></a>
</div>
<br />
<div class="table-responsive">
	<table id="table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Event</th>
				<th>Start</th>
				<th>End</th>
				<th>Location</th>
				<th>Lead</th>
			</tr>
		</thead>
		<tbody>
		@foreach($events as $event)
			<tr>
				<td><a href="/event/{!! $event->id !!}"><i class="glyphicon glyphicon-eye-open"></i></a></td>
				<td>{!! $event->title !!}</td>
				<td>{!! $event->start_at->format('m/d/Y h:i a') !!}</td>
				<td>{!! $event->end_at->format('m/d/Y h:i a') !!}</td>
				<td>{!! $event->location !!}</td>
				<td>{!! $event->lead->name !!}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<script>
</script>
@endsection


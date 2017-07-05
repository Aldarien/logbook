@extends('layout.base')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{$year->getYear()}}</div>
	<div class="panel-body">
@foreach ($year->getMonths() as $i => $month)
 	@if ($i > 0 and $i % 3 == 0)
 		</div>
		<div class="row">
	@elseif ($i == 0)
		<div class="row">
	@endif
			<div class="col-md-4">
				@include('show_month')
			</div>
@endforeach
	</div>
</div>
@endsection
@extends('layouts.base')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">{{$year->year}}</div>
	<div class="panel-body">
@for ($i = 0; $i < 12; $i ++)
@if ($i > 0 and ($i + 1) % 3 == 0)
@if ($i > 3)
		</div>
@endif
		<div class="row">
@endif
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">{{$year->months[$i]->month}}</div>
					<div class="panel-body"></div>
				</div>
			</div>
@endfor
	</div>
</div>
@endsection
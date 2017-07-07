@extends('layout.base')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="day.php?day={{$day->getPreviousDay()}}"><span class="glyphicon glyphicon-chevron-left"></span></a>
		{{$day->getDay()}} {{ucwords($day->getMonth()->getMonthName())}} {{$day->getMonth()->getYear()->getYear()}}
		@if ($day->getNextDay() != null)
		<a href="day.php?day={{$day->getNextDay()}}"><span class="glyphicon glyphicon-chevron-right"></span></a>
		@endif
	</div>
	<div class="panel-body">
		<div class="panel panel-default">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">{{translate('Unfinished Events')}}</div>
                    <div class="col-md-2"><a href="add.php?type=future"><span class="glyphicon glyphicon-plus"></span></a></div>
                </div>
            </div>
			<div class="panel-body">
				@include('show_future_events', ['events' => $day->getFutureEvents()])
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">{{translate("Today's Finished Events")}}</div>
                    <div class="col-md-2"><a href="add.php?type=past"><span class="glyphicon glyphicon-plus"></span></a></div>
                </div>
            </div>
			<div class="panel-body">
				@include('show_past_events', ['events' => $day->getPastEvents()])
			</div>
		</div>
	</div>
</div>
@endsection

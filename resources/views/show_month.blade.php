<div class="panel panel-default">
	<div class="panel-heading">{{ucwords($month->getMonthName())}}</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('monday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('tuesday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('wendesday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('thursday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('friday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('saturday')), 0, 1))}}</div>
			<div class="col-md-1 bold">{{ucwords(substr(strftime('%a', strtotime('sunday')), 0, 1))}}</div>
		</div>
	@foreach ($month->getWeeks() as $week)
		<div class="row">
		@foreach ($week->getDays() as $day)
			@if ($day)
			<div class="col-md-1
			@if ($day->getMonth()->getMonth() != $month->getMonth())
				faded 
			@endif"><a href="day.php?day={{$day->getTimestamp()}}">{{$day->getDay()}}</a></div>
			@else
				<div class="col-md-1"></div>
			@endif
		@endforeach
		</div>
	@endforeach
	</div>
</div>
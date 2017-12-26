<div class="col-md-2"><a href="day.php?day={{$day->getTimestamp()}}"><div class="well h1 text-center">{{$day->getDay()}}</div></a></div>
<div class="col-md-10">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">{{translate('Unfinished Events')}}</div>
                    <div class="col-md-2 text-right"><a href="add.php?type=future"><span class="glyphicon glyphicon-plus"></span></a></div>
                </div>
            </div>
			<div class="panel-body">
				@include('show_future_events', ['events' => $day->getFutureEvents()])
			</div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
			<div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">{{translate("Today's Finished Events")}}</div>
                    <div class="col-md-2 text-right"><a href="add.php?type=past"><span class="glyphicon glyphicon-plus"></span></a></div>
                </div>
            </div>
			<div class="panel-body">
				@include('show_past_events', ['events' => $day->getPastEvents()])
			</div>
		</div>
    </div>
</div>

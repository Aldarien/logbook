@foreach ($events as $event)
<div class="row">
	<div class="col-md-12">{{$event->getDescription()}} 
	@if ($event->getState() == 'ongoing')
		<a href="finish_event.php?event={{$event->getId()}}"><span class="glyphicon glyphicon-check"></span></a>
	@else
		<span class="glyphicon glyphicon-thumbs-up"></span>
	@endif
	</div>
</div>
@endforeach
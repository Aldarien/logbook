@foreach ($events as $event)
<div class="row">
	<div class="col-md-12">{{$event->getDescription()}}</div>
</div>
@endforeach
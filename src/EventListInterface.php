<?php
namespace Logbook\Models;

interface EventListInterface
{
	public function addEvent(EventInterface $event);
	public function getEventPosition(string $description);
	public function removeEvent(int $i);
	public function getOngoingEvents();
	public function changeEventState($i);
	public function show();
}
?>
<?php
namespace Logbook\Models;

class EventList implements EventListInterface, \Iterator
{
	protected $events;
	protected $current;
	
	public function __construct()
	{
		$this->rewind();
		$this->events = [];
	}
	
	public function loadEvents(array $events)
	{
		foreach ($events as $event) {
			$this->addEvent($event);
		}
		return $this;
	}
	public function addEvent(EventInterface $event)
	{
		$this->events []= $event;
		return $this;
	}
	public function getEventPosition(string $description)
	{
		foreach ($this->events as $i => $event) {
			if ($event->getDescription() == $description) {
				return $i;
			}
		}
		return null;
	}
	public function removeEvent(int $i)
	{
		if (isset($this->events[$i])) {
			unset($this->events[$i]);
			$this->events = array_merge($this->events);
		}
	}
	public function getOngoingEvents()
	{
		$ongoing = [];
		foreach ($this->events as $event) {
			if ($event->getState() == 'ongoing') {
				$ongoing []= $event;
			}
		}
		
		return $ongoing;
	}
	public function changeEventState($i)
	{
		if (isset($this->events[$i])) {
			$this->events[$i]->changeState();
		}
		
		return $this;
	}
	public function show()
	{
		$output = [];
		foreach ($this->events as $event) {
			$output []= $event->show();
		}
		
		return $output;
	}
	
	public function current()
	{
		return $this->events[$this->current];
	}
	public function key()
	{
		return $this->current;
	}
	public function next()
	{
		$this->current ++;
	}
	public function rewind()
	{
		$this->current = 0;
	}
	public function valid()
	{
		return isset($this->events[$this->current]);
	}
}
?>
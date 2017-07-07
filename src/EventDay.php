<?php
namespace Logbook\Models;

use Carbon\Carbon;

class EventDay
{
	protected $day;
	protected $lists;

	protected $month = null;

	public function __construct($year, $month, $day)
	{
		$this->day = Carbon::createFromDate($year, $month, $day, config('app.timezone'));
		$this->lists = ['future' => new EventList(), 'past' => new EventList()];
		$this->loadEvents();
	}
	protected function loadEvents()
	{
        $future = FutureEvent::loadAll([['start', $this->day->format('Y-m-d'), '<='], ['end', 0]]);
        if ($future) {
			$this->lists['future']->loadEvents($future);
		}
		$past = PastEvent::loadAll([['start', $this->day->format('Y-m-d')]]);
		if ($past) {
			$this->lists['past']->loadEvents($past);
		}
		return $this;
	}
	public function getDay()
	{
		return $this->day->day;
	}
	public function getMonth()
	{
		if (!$this->month) {
			$this->month = new EventMonth($this->day->year, $this->day->month);
		}
		return $this->month;
	}
	public function getTimestamp()
	{
		return $this->day->timestamp;
	}
	public function addEvent($type, EventInterface $event)
	{
		$this->list[$type]->addEvent($event);
		return $this;
	}
	public function getPreviousDay()
	{
		return $this->day->copy()->subDay()->timestamp;
	}
	public function getNextDay()
	{
		$today = Carbon::today(config('app.timezone'));
		if ($this->day->format('Y-m-d') == $today->format('Y-m-d')) {
			return null;
		}
		return $this->day->copy()->addDay()->timestamp;
	}
	public function addOngoingEvents(array $events)
	{
		foreach ($events as $event) {
			$this->addEvent('future', $event);
		}

		return $this;
	}
	public function getOngoingEvents()
	{
		return $this->lists['future']->getOngoingEvents();
	}
	public function findEvent(string $description)
	{
		$i = $this->lists['future']->getEventPosition($description);
		if ($i) {
			return $i;
		}
		return $this->lists['past']->getEventPosition($description);
	}

	public function getFutureEvents()
	{
		return $this->lists['future'];
	}
	public function getPastEvents()
	{
		return $this->lists['past'];
	}
}
?>

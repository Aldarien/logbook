<?php
namespace Logbook\Models;

use Carbon\Carbon;

class EventYear
{
	/**
	 * The year
	 * @var int
	 */
	protected $year;
	/**
	 * All the EventMonths in this year
	 * @var array
	 */
	protected $months;
	protected $current;
	
	public function __construct($year = null)
	{
		if (!$year) {
			$year = Carbon::today(config('app.timezone'))->year;
		}
		$this->setYear($year);
		for ($i = 0; $i < 12; $i ++) {
			$this->addMonth($i + 1, $year);
		}
	}
	public function setYear($year)
	{
		$this->year = $year;
	}
	public function addMonth($month_number)
	{
		$this->months []= new EventMonth($this->year, $month_number);
		return $this;
	}
	public function getYear()
	{
		return $this->year;
	}
	public function getMonth($month_number)
	{
		return $this->months[$i - 1];
	}
	public function getMonths()
	{
		return $this->months;
	}
	public function getToday()
	{
		$today = Carbon::today(config('app.timezone'));
		return $this->months[$today->month - 1]->getWeek()->getToday();
	}
	public function saveEvents()
	{
		foreach ($this->months as $month) {
			$month->saveEvents();
		}
		
		return $this;
	}
}
?>
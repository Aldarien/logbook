<?php
namespace Logbook\Models;

use Carbon\Carbon;

class EventMonth
{
	protected $weeks;
	protected $month_number;
	protected $year = null;
	protected $date;
	
	/**
	 *  TODO:
	 *  Month is identified by the year and the month number
	 *  Month should be able to tell week when it starts for the first day of the month
	 *   and should be able to add weeks until the last day of the month
	 */
	
	public function __construct($year, $month_number)
	{
		$this->month_number = $month_number;
		$this->date = Carbon::createFromDate($year, $month_number, 1, config('app.timezone'));
		
		$date = $this->date->copy()->endOfMonth();
		$wks = $date->weekOfMonth;
		for ($w = 0; $w <= $wks; $w ++) {
			$week_number = $this->date->weekOfYear + $w;
			$this->addWeek(new EventWeek($this->date->year, $this->date->month, $week_number, $this->date->yearIso));
		}
	}
	public function addWeek(EventWeek $week)
	{
		$this->weeks []= $week;
	}
	public function getMonth()
	{
		return $this->date->month;
	}
	public function getYear()
	{
		if (!$this->year) {
			$this->year = new EventYear($this->date->year);
		}
		return $this->year;
	}
	public function getMonthName()
	{
		return strftime('%B', $this->date->timestamp);
	}
	public function getWeeks()
	{
		return $this->weeks;
	}
}
?>
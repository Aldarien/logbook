<?php
namespace Logbook\Models;

use Carbon\Carbon;

class EventWeek
{
	protected $year;
	protected $week_number;
	protected $date;
	protected $days;

	public function __construct($year, $month, $week_number, $yearIso = null)
	{
		$this->year = $year;
		$this->week_number = $week_number;
		$date = Carbon::today(config('app.timezone'));
		if ($yearIso) {
			$date->setISODate($yearIso, $week_number);
		} else {
			$date->setISODate($year, $week_number);
		}
		$this->date = $date;

		for ($i = 0; $i < 7; $i ++) {
			$m = $this->date->month;
			$day = $this->date->copy()->startOfWeek()->addDay($i);
			if ($day->month != $month) {
				$this->addDay();
			} else {
				$this->addDay($day);
			}
		}
	}

    public function getStart()
    {
        return $this->date->copy()->startOfWeek();
    }
    public function getEnd()
    {
        return $this->date->copy()->endOfWeek();
    }
	public function addDay($day = null)
	{
		$this->days []= $day;
	}
    public function loadDay($weekday_number)
    {
        $day = $this->getDay($weekday_number);
        if ($day !== null and !($day instanceOf EventDay)) {
            $this->days[$weekday_number - 1] = new EventDay($day->year, $day->month, $day->day);
        }
        return $this;
    }

    public function getDay($weekday_number)
    {
        if ($this->days[$weekday_number - 1] != null) {
            return $this->days[$weekday_number - 1];
        }
        return null;
    }
	public function getDays($obj = false)
	{
        if ($obj) {
            foreach ($this->days as $i => $day) {
                $this->loadDay($i + 1);
            }
            return $this->days;
        }
		return $this->days;
	}
    public function getWeek()
    {
        return $this->week_number;
    }
    public function getYear($obj = false)
    {
        if ($obj) {
            return new EventYear($this->year);
        }
        return $this->year;
    }
    public function getMonth($obj = false)
    {
        if ($obj) {
            return new EventMonth($this->year, $this->date->month);
        }
        return $this->date->month;
    }
}
?>

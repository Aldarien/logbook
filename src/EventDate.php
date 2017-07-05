<?php
namespace Logbook\Models;

use Carbon\Carbon;

class EventDate
{
	protected $start;
	protected $end;
	
	public function __construct($date = null, $type = 'ongoing')
	{
		if ($date) {
			switch($type) {
				case 'ended':
					$this->setEnd($date);
				case 'ongoing':
					$this->setStart($date);
					break;
			}
		}
	}
	
	protected function checkFormat($date, $timezone = null)
	{
		if (is_string($date) and !isset($timezone)) {
			throw new \Exception('Missing timezone in EventDate::setStart call.');
		} elseif (is_string($date)) {
			$date = Carbon::parse($date, $timezone);
		} elseif ($date instanceof \DateTime) {
			$date = Carbon::instance($date);
		} elseif (!($date instanceof Carbon)) {
			return null;
		}
		
		return $date;
	}
	public function setStart($date, $timezone = null)
	{
		$this->start = $this->checkFormat($date, $timezone);
		return $this;
	}
	public function setEnd($date, $timezone = null)
	{
		$this->end = $this->checkFormat($date, $timezone);
		return $this;
	}
	
	public function getStart($format = null)
	{
		if ($format) {
			return $this->start->format($format);
		}
		return $this->start;
	}
	public function getEnd($format = null)
	{
		if ($format) {
			return $this->end->format($format);
		}
		return $this->end;
	}
	public function length()
	{
		$dif = $this->end->diffInDays($this->start);
		return $dif;
	}
}
?>
<?php
namespace Logbook\Models;

use Logbook\App\DBObject;
use Carbon\Carbon;

class Event extends DBObject implements EventInterface
{
	protected $category;
	protected $date;
	protected $description;
	protected $state;
	
	public function __construct()
	{
		$this->date = new EventDate(Carbon::now(config('app.timezone')), $this->state);
	}
	public function setCategory(EventCategory $category)
	{
		$this->category = $category->getId();
	}
	public function setDate($date, $type = 'start')
	{
		$func = 'set' . ucwords($type);
		$timezone = null;
		if (is_string($date)) {
			$timezone = 'America/Santiago';
		}
		$this->date->{$func}($date, $timezone);
		
		return $this;
	}
	public function setDescription(string $description)
	{
		$this->description = $description;
		
		return $this;
	}
	public function changeState()
	{
		if ($this->state == 'ongoing') {
			$this->state = 'ended';
		}
		
		return $this;
	}
	
	public function getDate($type = null)
	{
		if ($type == null) {
			return $this->date;
		}
		$func = 'get' . ucwords($type);
		return $this->date->{$func}();
	}
	public function getCategory()
	{
		$category = new EventCategory();
		$category->load($this->category);
		return $category;
	}
	public function getState()
	{
		return $this->state;
	}
	public function getDescription()
	{
		return $this->description;
	}
	
	public function ask()
	{
		
	}
	public function show($modifier)
	{
		
	}
}
?>
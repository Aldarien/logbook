<?php
namespace Logbook\Models;

use Carbon\Carbon;

class FutureEvent extends Event
{
	public function __construct()
	{
		$this->state = 'ongoing';
		parent::__construct();
	}
	public function ask()
	{
		return '&iquest;Que se va a hacer?';
	}
	public function show($modifier)
	{
		if ($this->state == 'ongoing') {
			return ['category' => $this->getCategory(), 'date' => $this->date->getStart('Y-m-d'), 'description' => $this->getDescription()];
		}
		return ['category' => $this->getCategory(), 'date' => $this->date->getStart('Y-m-d'), 'description' => $this->getDescription(), 'end' => $this->date->getEnd('Y-m-d')];
	}
}
?>
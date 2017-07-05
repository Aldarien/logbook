<?php
namespace Logbook\Models;

use Carbon\Carbon;

class PastEvent extends Event
{
	public function __construct()
	{
		$this->state = 'ended';
		parent::__construct();
	}
	
	public function ask()
	{
		return '&iquest;Que se hizo?';
	}
	public function show($modifier)
	{
		return ['category' => $this->getCategory(), 'date' => $this->date->getStart('Y-m-d'), 'description' => $this->getDescription()];
	}
}
?>
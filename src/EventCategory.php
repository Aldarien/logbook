<?php
namespace Logbook\Models;

use Logbook\App\DBObject;

class EventCategory extends DBObject
{
	protected $description;
	
	public function __construct(string $description = '')
	{
		if ($description != '') {
			$this->setDescription($description);
		}
	}
	
	public function setDescription(string $description)
	{
		$this->description = $description;
	}
	public function getDescription()
	{
		return $this->description;
	}
	
	public function __toString()
	{
		return '' . $this->getDescription();
	}
}
?>
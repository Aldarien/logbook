<?php
namespace Logbook\App;

class DB
{
	protected static $instance = null;
	
	private function __construct() {}
	
	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new DBHandler();
		}
		return self::$instance;
	}
}
?>
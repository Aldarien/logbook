<?php
namespace Logbook\App;

class Config
{
	protected static $config = null;
	
	private function __construct() {}
	
	protected static function getInstance()
	{
		if (!self::$config) {
			self::$config = new ConfigService();
		}
		return self::$config;
	}
	public static function get($name)
	{
		$config = self::getInstance();
		return $config->$name;
	}
}
?>
<?php
namespace Logbook\App;

class Translator
{
	protected static $instance = null;
	
	private function __construct() {}
	
	protected static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new TranslatorService();
		}
		return self::$instance;
	}
	public static function translate($name)
	{
		$instance = self::getInstance();
		return $instance->translate($name);
	}
}
?>
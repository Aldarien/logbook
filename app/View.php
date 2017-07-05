<?php
namespace Logbook\App;

class View
{
	protected static $view = null;
	
	private function __construct() {}
	
	protected static function getInstance()
	{
		if (!self::$view) {
			self::$view = new ViewService();
		}
		return self::$view;
	}
	public static function show($template, $vars = null)
	{
		$view = self::getInstance();
		return $view->show($template, $vars);
	}
}
?>
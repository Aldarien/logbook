<?php
namespace Logbook\App;

class ConfigService
{
	protected $dir;
	protected $data;
	
	public function __construct($dir = __DIR__ . '/../config')
	{
		$this->dir = $dir;
		$this->load();
	}
	
	protected function load()
	{
		$this->data = [];
		$files = glob($this->dir . '/*.php');
		foreach ($files as $file) {
			$info = pathinfo($file);
			$this->data[$info['filename']] = [];
			$data = include_once $file;
			foreach ($data as $name => $value) {
				if (strpos($value, '{') !== false) {
					$end = 0;
					while (strpos($value, '{') !== false) {
						$ini = strpos($value, '{', $end) + 1;
						$end = strpos($value, '}', $ini);
						if ($end - $ini < 1) {
							break;
						}
						$n = substr($value, $ini, $end - $ini);
						$value = str_replace('{' . $n . '}', $this->$n, $value);
					}
				}
				$this->data[$info['filename']][$name] = $value;
			}
		}
	}
	
	public function __get($name)
	{
		list($file, $var) = explode('.', $name);
		return $this->data[$file][$var];
	}
}
?>
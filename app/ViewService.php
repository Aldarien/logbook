<?php
namespace Logbook\App;

use Philo\Blade\Blade;

class ViewService
{
	protected $view;
	protected $cache;
	protected $blade;
	
	public function __construct()
	{
		$this->views = config('locations.template-dir');
		$this->cache = config('locations.cache-dir');
		
		$this->blade = new Blade($this->views, $this->cache);
	}
	public function show($template, $vars = null)
	{
		if ($vars) {
			return $this->blade->view()->make($template, $vars)->render();
		}
		return $this->blade->view()->make($template)->render();
	}
}
?>
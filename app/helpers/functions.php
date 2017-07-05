<?php
function config($name) {
	return Logbook\App\Config::get($name);
}
function view($template, $vars = null)
{
	return Logbook\App\View::show($template, $vars);
}
function translate($frase)
{
	return Logbook\App\Translator::translate($frase);
}
function today()
{
	return Carbon\Carbon::today(config('app.timezone'));
}
function db()
{
	return Logbook\App\DB::getInstance();
}
?>
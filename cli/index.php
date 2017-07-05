<?php
include_once dirname(__DIR__) . '/autoload/autoload.php';

use Logbook\Models\EventDay;
use Carbon\Carbon;

$today = Carbon::today(config('app.timezone'));
$day = new EventDay($today->day, $today->month, $today->year);

include_once config('locations.cli-dir') . '/CLI.php';
CLI::Parse($day->show());
$cmd = '';
$params = null;
while ($cmd != 'E') {
	var_dump($params);
	CLI::menu($params);
	$cmd = strtoupper(trim(fgets(STDIN)));
	$params = CLI::command($cmd, $params);
}
?>
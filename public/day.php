<?php
include_once __DIR__ . '/../autoload/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

if (isset($_GET['day'])) {
	$day = Carbon::createFromTimestamp($_GET['day'], config('app.timezone'));
} else {
	$day = Carbon::today(config('app.timezone'));
}

$day = new Logbook\Models\EventDay($day->year, $day->month, $day->day);
echo view('day', compact('day'));
?>
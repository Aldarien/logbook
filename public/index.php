<?php
include_once __DIR__ . '/../autoload/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

$today = Carbon::today(config('app.timezone'));
$day = new Logbook\Models\EventDay($today->year, $today->month, $today->day);
echo view('day', compact('day'));
?>
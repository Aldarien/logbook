<?php
include_once __DIR__ . '/../bootstrap/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

if (isset($_GET['event'])) {
	$today = Carbon::today(config('app.timezone'));
	
	$event = new Logbook\Models\FutureEvent();
	$event->load($_GET['event']);
	$event->setDate($today, 'end')->changeState();
	$event->save();
}

header('Location: .');
?>
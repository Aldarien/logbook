<?php
include_once __DIR__ . '/../autoload/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

if (isset($_POST['description'])) {
	$day = null;
	switch ($_POST['type']) {
		case 'future':
			$day = new Logbook\Models\FutureEvent();
			break;
		case 'past':
			$day = new Logbook\Models\PastEvent();
			break;
	}
	$day->setDescription($_POST['description']);
	$category = new Logbook\Models\EventCategory();
	$category->load($_POST['category']);
	$day->setCategory($category);
	
	$day->save();
	header('Location: .');
}

$type = 'future';
if (isset($_GET['type'])) {
	$type = $_GET['type'];
}
$today = Carbon::today(config('app.timezone'));
$categories = Logbook\Models\EventCategory::loadAll();
echo view('add', compact('type', 'today', 'categories'));
?>
<?php
include_once __DIR__ . '/../autoload/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

$today = Carbon::today(config('app.timezone'));
$year = $today->year;
if (isset($_GET['year']) and ctype_digit($_GET['year'])) {
    $year = $_GET['year'];
}

$year = new Logbook\Models\EventYear($year);
echo view('year', compact('year', 'today'));
?>

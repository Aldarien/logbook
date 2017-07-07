<?php
include_once __DIR__ . '/../autoload/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

$today = Carbon::today(config('app.timezone'));
$year = $today->year;
$month = $today->month;
$week = $today->weekOfYear;
if (isset($_GET['year']) and ctype_digit($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['month']) and ctype_digit($_GET['month'])) {
    $week = $_GET['month'];
}
if (isset($_GET['week']) and ctype_digit($_GET['week'])) {
    $week = $_GET['week'];
}

$week = new Logbook\Models\EventWeek($year, $month, $week);
echo view('week', compact('week', 'today'));
?>

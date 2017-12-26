<?php
include_once __DIR__ . '/../bootstrap/autoload.php';

setlocale(LC_TIME, config('app.locale'));

use Carbon\Carbon;

$today = Carbon::today(config('app.timezone'));
$year = $today->year;
$month = $today->month;
if (isset($_GET['year']) and ctype_digit($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['month']) and ctype_digit($_GET['month'])) {
    $month = $_GET['month'];
}

$month = new Logbook\Models\EventMonth($year, $month);
echo view('month', compact('month', 'today'));
?>

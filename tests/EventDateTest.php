<?php
use PHPUnit\Framework\TestCase;
use Logbook\Models\EventDate;
use Carbon\Carbon;

class EventDateTest extends TestCase
{
	function testConstructor()
	{
		$date1 = '2017-06-05';
		$timezon = 'America/New_York';
		$date2 = new \DateTime('2016-05-04');
		
		$this->expectException(\Exception::class);
		$ed = new EventDate($date1);
		$ed = new EventDate($date2);
		$this->assertEquals($date2, $ed->getStart());
		$ed = new EventDate($date2, 'ended');
		$this->assertEquals($date2, $ed->getStart());
		$this->assertEquals($date2, $ed->getEnd());
	}
	function testSetDates()
	{
		$ed = new EventDate();
		$date1 = '2017-06-05';
		$timezone = 'America/New_York';
		$date2 = new \DateTime('2016-05-04');
		
		$ed->setStart($date1, $timezone);
		$this->assertEquals($date1, $ed->getStart('Y-m-d'));
		
		$ed->setEnd($date2);
		$this->assertEquals($date2, $ed->getEnd());
		
		$diff = Carbon::instance($date2)->diffInDays(Carbon::parse($date1, $timezone));
		$this->assertEquals($diff, $ed->length());
	}
}
?>
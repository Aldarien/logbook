<?php
namespace Logbook\Models;

interface EventInterface
{
	/**
	 * Set the category
	 * @param EventCategory $category
	 */
	public function setCategory(EventCategory $category_id);
	/**
	 * Set the dates. Either start or end.
	 * @param [start or end] $type, the type of date that is being set
	 * @param [string, DateTime, Carbon] $date
	 * @param [optional string] $timezone, if the date is string then a timezone string needs to be specified
	 */
	public function setDate($date, $type = 'start');
	public function setDescription(string $description);
	/**
	 * The state can be ongoing or ended. This function changes from ongoing to ended.
	 */
	public function changeState();
	
	public function getDate($type);
	public function getCategory();
	public function getState();
	public function getDescription();
	
	/**
	 * Ask the question for the type of event
	 */
	public function ask();
	public function show($modifier);
}
?>
<?php
use PHPUnit\Framework\TestCase;
use Logbook\App\DBHandler;
use Logbook\Models\EventCategory;

class EventCategoryTest extends TestCase
{
	public function testLoad()
	{
		$id = 1;
		$db = new DBHandler();
		$description = 'General';
		
		$cat = new EventCategory();
		$cat->load($db, $id);
		
		$this->assertEquals($description, $cat->getDescription());
	}
	public function testSaveAndRemove()
	{
		$id = 2;
		$description = 'TestCat';
		$db = new DBHandler();
		
		$cat = new EventCategory();
		$cat->setId($id);
		$cat->setDescription($description);
		$cat->save($db);
		
		$cat = new EventCategory();
		$cat->load($db, $id);
		$this->assertEquals($description, $cat->getDescription());
		
		$cat->remove($db);
	}
	public function testFind()
	{
		$description = 'General';
		$db = new DBHandler();
		$id = 1;
		
		$cat = new EventCategory();
		$cat->find($db, $description);
		
		$this->assertEquals($id, $cat->getId());
	}
}
?>
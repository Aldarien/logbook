<?php
namespace Logbook\App;

use Stringy\Stringy;

class DBObject
{
	protected $id;
	
	protected function getFields()
	{
		$fields = [];
		foreach ($this as $field => $value) {
			if ($field == 'table') {
				continue;
			} elseif ($field == 'date') {
				$fields []= 'start';
				$fields []= 'end';
			} else {
				$fields []= $field;
			}
		}
		
		return $fields;
	}
	protected function tableName()
	{
		if (isset($this->table)) {
			return $this->table;
		}
		
		$class = Stringy::create(get_class($this));
		$class = '' . $class->slice($class->indexOfLast("\\") + 1);
		$name = Stringy::create($class)->underscored();
		if ($name->at(-1) == 'y') {
			$name = $name->removeRight('y')->append('ies');
		} elseif ($name->at(-1) != 's') {
			$name = $name->append('s');
		}
		
		return '' . $name;
	}
	public function load(int $id)
	{
		$db = db();
		$data = $db->table($this->tableName())->select($this->getFields())->where(['id', $id])->runQuery();
		if ($data) {
			$this->fill($data);
		}
	}
	public function save()
	{
		$db = db();
		$data = [];
		foreach ($this->getFields() as $field) {
			if ($field == 'start' or $field == 'end') {
				$field = 'date';
			}
			$func = '' . Stringy::create('get' . ucwords($field))->camelize();
			$data[$field] = $this->{$func}();
			if (is_object($data[$field])) {
				$class = get_class($data[$field]);
				if ($class == 'Logbook\Models\EventDate') {
					$data['start'] = $data[$field]->getStart()->format('Y-m-d');
					if ($data[$field]->getEnd() != null) {
						$data['end'] = $data[$field]->getEnd()->format('Y-m-d');
					} else {
						$data['end'] = 0;
					}
					unset($data[$field]);
				} else {
					$data[$field] = $data[$field]->getId();
				}
			}
		}
		if ($this->checkIfSaved($db)) {
			$this->update($data);
		} else {
			return $db->table($this->tableName())->insert($data)->runQuery();
		}
	}
	protected function checkIfSaved()
	{
		if ($this->id == null) {
			return false;
		}
		$db = db();
		$data = $db->table($this->tableName())->select($this->getFields())->where(['id', $this->getId()])->runQuery();
		if ($data) {
			return true;
		}
		return false;
	}
	protected function update($data)
	{
		$db = db();
		unset($data['id']);
		$input = [];
		foreach ($data as $field => $value) {
			$input []= [$field, $value];
		}
		return $db->table($this->tableName())->update($input)->where(['id', $this->getId()])->runQuery();
	}
	public function remove()
	{
		$db = db();
		return $db->table($this->tableName())->delete(['id' => $this->getId()])->runQuery();
	}
	public function search($data)
	{
		$db = db();
		$data = $db->table($this->tableName())->select($this->getFields())->where($data)->runQuery();
		if (is_array($data)) {
			$first = array_shift($data);
			$this->fill($first);
			
			$results = [];
			foreach ($data as $item) {
				$class = get_class($this);
				$obj = new $class();
				$obj->fill($item);
				$results []= $obj;
			}
			return $results;
		}
		if ($data) {
			$this->fill($data);
		}
	}
	protected function getParameters($method, $values)
	{
		$ref = new \ReflectionMethod($this, $method);
		$params = $ref->getParameters();
		$input = [];
		foreach ($params as $i => $param) {
			if ($param->hasType() and $param->getClass() != null) {
				$class = $param->getClass()->name;
				if (class_exists($class)) {
					$obj = new $class();
					$obj->load($values[$i]);
					$input []= $obj;
				} else {
					$input []= $values[$i];
				}
			} else {
				$input []= $values[$i];
			}
		}
		
		return $input;
	}
	protected function fill($data)
	{
		foreach ($this->getFields() as $field) {
			$func = '' . Stringy::create('set' . ucwords($field))->camelize();
			try {
				if ($field == 'date' or $field == 'start' or $field == 'end') {
					$this->setDate($data->start, 'start');
					$this->setDate($data->end, 'end');
				} elseif ($field == 'state') {
					if ($data->state == 'ended') {
						$this->changeState();
					}
				} else {
					$input = $this->getParameters($func, [$data->$field]);
					$this->{$func}($input[0]);
				}
			} catch (\Exception $e) {
				try {
					$class = 'Event' . ucwords($field);
					$obj = new $class();
					$obj->load($data->$field);
					$this->{$func}($obj);
				} catch (\Exception $e) {
					throw $e;
				}
			}
		}
	}
	
	public static function loadAll($wheres = null)
	{
		$db = db();
		$st = $db->table(self::tName())->select('*');
		if ($wheres) {
			foreach ($wheres as $where) {
				$st->where($where);
			}			
		}
		$data = $st->runQuery();
		if ($data) {
			$output = [];
			if (is_array($data)) {
				foreach ($data as $item) {
					$class = get_called_class();
					$obj = new $class();
					$obj->fill($item);
					
					$output []= $obj;
				}
			} else {
				$class = get_called_class();
				$obj = new $class();
				$obj->fill($data);
				$output []= $obj;
			}
			return $output;
		}
		
		return null;
	}
	protected static function className()
	{
		$class = Stringy::create(get_called_class());
		$class = $class->slice($class->indexOfLast("\\") + 1);
		
		return '' . $class;
	}
	protected static function tName()
	{
		$name = Stringy::create(self::className())->underscored();
		if ($name->at(-1) == 'y') {
			$name = $name->removeRight('y')->append('ies');
		} elseif ($name->at(-1) != 's') {
			$name = $name->append('s');
		}
		return '' . $name;
	}
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}
	public function getId()
	{
		return $this->id;
	}
}
?>
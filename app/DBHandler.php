<?php
namespace Logbook\App;

class DBHandler
{
	protected $table;
	protected $joins;
	protected $query_type;
	protected $fields;
	protected $wheres;
	protected $where_values;
	protected $handler;
	protected $inserts;
	protected $insert_values;
	
	public function __construct()
	{
		switch (config('database.type')) {
			case 'mysql':
				$this->handler = new \PDO(
				'mysql:host=' . config('database.host') . ';port=' . config('database.port') . ';dbname=' . config('database.name'),
					config('database.username'),
					config('database.password')
				);
		}
	}
	
	/**
	 * Specify the tables for the query
	 * @param [string or array] $tables
	 */
	public function table($tables)
	{
		if (is_array($tables)) {
			$this->table = $this->parseName(array_shift($tables));
			foreach ($tables as $table_data) {
				$this->join($table_data);
			}
		} else {
			$this->table = $this->parseName($tables);
		}
		
		return $this;
	}
	protected function parseName($name)
	{
		if ($name == '*') {
			return $name;
		}
		if (strpos($name, '.')) {
			list($t, $c) = explode('.', $name);
			return $this->parseName($t) . '.' . $this->parseName($c);
		}
		return '`' . $name . '`';
	}
	/**
	 * Add join to query
	 * @param array $table_data, {{table1, column1}, {table2, column2}[, operand = '='][, join_type = 'INNER JOIN']}
	 */
	public function join(array $table_data)
	{
		$col1 = $this->parseColumn($table_data[0]);
		$col2 = $this->parseColumn($table_data[1]);
		$op = '=';
		if (isset($table_data[2])) {
			switch ($table_data[2]) {
				case '>':
				case '>=':
				case '<':
				case '<=':
				case '=':
					$op = $table_data[2];
					break;
				default:
					$op = '=';
			}
		}
		$type = 'INNER JOIN';
		if (isset($table_data[3])) {
			switch ($table_data[3]) {
				case 'JOIN':
				case 'INNER JOIN':
				case 'LEFT JOIN':
				case 'RIGHT JOIN':
				case 'OUTER JOIN':
				case 'LEFT OUTER JOIN':
				case 'RIGHT OUTER JOIN':
				case 'UNION':
					$type = $table_data[3];
					break;
				default:
					$type = 'INNER JOIN';
			}
		}
		
		$this->joins []= $type . ' ' . $col1 . ' ' . $op . ' ' . $col2;
		return $this;
	}
	/**
	 * Parse table and column to table.column
	 * @param array $column_data, {table, column}
	 * @return string
	 */
	protected function parseColumn(array $column_data)
	{
		return $this->parseName($column_data[0]) . '.' . $this->parseName($column_data[1]);
	}
	public function insert(array $data)
	{
		$this->query_type = 'INSERT INTO';
		foreach ($data as $field => $value) {
			$this->inserts []= $this->parseName($field);
			$this->insert_values []= $value;
		}
		return $this;
	}
	/**
	 * 
	 * @param [string or array] $fields, the field or fields that are selected
	 */
	public function select($fields)
	{
		$this->query_type = 'SELECT';
		if (is_array($fields)) {
			foreach ($fields as $field_data) {
				if (is_array($field_data)) {
					$this->fields []= $this->parseField($field_data);
				} else {
					$this->fields []= $this->parseName($field_data);
				}
			}
		} else {
			$this->fields []= $this->parseName($fields);
		}
		
		return $this;
	}
	/**
	 * 
	 * @param array $field_data, {table, field[, alias]}
	 * @return string
	 */
	protected function parseField(array $field_data)
	{
		if (!isset($field_data[2])) {
			return $this->parseColumn($field_data);
		}
		$alias = array_pop($field_data);
		return $this->parseColumn($field_data) . ' AS ' . $this->parseName($alias);
	}
	
	public function where(array $where_data)
	{
		/**
		 * 1 {column, value}
		 * 2 {column, value, operand}
		 * 3 {column, value_array[, operand]}
		 * 4 {{table, column}, value[, operand]}
		 * 5 {{table, column}, value_array[, operand]}
		 * 6 {{column1, value1[, operand1]}, ..}
		 * 7 {{column1, value_array1[, operand1]}, ..}
		 * 8 {{{table1, column1}, value1[, operand1]}, ..}
		 * 9 {{{table1, column1}, value_array1[, operand1]}, ..}
		 */
		
		if (is_array($where_data[0])) {
			// cases 4 - 9
			if (is_array($where_data[0][0])) {
				// cases 8 - 9
				foreach ($where_data as $where_line) {
					$this->parseWhere($where_line);
				}
			} else {
				// cases 4 - 7
				/**
				 * {{table, column}, value_array#2}
				 * {{column1, value1}, {column2, value2}}
				 * 
				 * {{table, column}, value_array#2, operand}
				 * {{column1, value1}, {column2, value2}, {column3, value3}}
				 */
				if (count($where_data) <= 2) {
					// No idea
				} else {
					if (is_array($where_data[3])) {
						// cases 6 - 7
						foreach ($where_data as $where_line) {
							$this->parseWhere($where_line);
						}
					} else {
						// cases 4 - 5 +operand
						$this->parseWhere($where_data);
					}
				}
			}
		} else {
			// cases 1 - 3
			$this->parseWhere($where_data);
		}
		
		return $this;
	}
	/**
	 * 
	 * @param array $where_line
	 */
	protected function parseWhere(array $where_line)
	{
		/**
		 * 1 {column, value}
		 * 2 {column, value, operand}
		 * 3 {column, value_array[, operand]}
		 * 4 {{table, column}, value[, operand]}
		 * 5 {{table, column}, value_array[, operand]}
		 */
		
		$col = $this->parseName($where_line[0]);
		if (is_array($where_line[0])) {
			$col = $this->parseColumn($where_line[0]);
		}
		$val = $where_line[1];
		if (is_array($where_line[1])) {
			$val = '(' . implode(', ', $where_line[1]) . ')';
		}
		$op = '=';
		if (isset($where_line[3])) {
			switch (strtoupper($where_line[3])) {
				case '=':
				case '>':
				case '>=':
				case '<':
				case '<=':
				case 'LIKE':
				case 'NOT LIKE':
				case 'IN':
					$op = strtoupper($where_line[3]);
					break;
				default:
					$op = '=';
			}
		}
		
		$this->wheres []= $col . ' ' . $op . ' ?';
		$this->where_values []= $val;
	}
	public function delete(array $data)
	{
		$this->query_type = 'DELETE FROM';
		foreach ($data as $field => $value) {
			$this->wheres []= $field . ' = ?';
			$this->where_values []= $value;
		}
		
		return $this;
	}
	public function query()
	{
		switch ($this->query_type) {
			case 'SELECT':
				return $this->query_type . ' ' . (($this->fields) ? implode(', ', $this->fields) : '*') . ' FROM ' . $this->table .
					(($this->joins) ? ' ' . implode(' ', $this->joins) : '') .
					(($this->wheres) ? ' WHERE ' . implode(' AND ', $this->wheres) : '');
			case 'INSERT INTO':
				return $this->query_type . ' ' . $this->table . ' (' . implode(', ', $this->inserts) . ') VALUES (' . implode(', ', array_fill(0, count($this->inserts), '?')) . ')';
			case 'DELETE FROM':
				return $this->query_type . ' ' . $this->table . ' WHERE ' . implode(' AND ', $this->wheres);
			case 'UPDATE':
				return $this->query_type . ' ' . $this->table . ' SET ' . implode(' = ? , ', $this->inserts) . ' = ? WHERE ' . implode(' AND ', $this->wheres);
		}
	}
	
	public function runQuery()
	{
		$query = $this->query();
		$st = $this->handler->prepare($query);
		
		switch ($this->query_type) {
			case 'SELECT':
				$bool = $st->execute($this->where_values);
				$this->clear();
				if ($st->rowCount() > 1) {
					return $st->fetchAll(\PDO::FETCH_OBJ);
				} else {
					return $st->fetch(\PDO::FETCH_OBJ);
				}
			case 'INSERT INTO':
				$bool = $st->execute($this->insert_values);
				break;
			case 'DELETE FROM':
				$bool = $st->execute($this->where_values);
				break;
			case 'UPDATE':
				$array = array_merge($this->insert_values, $this->where_values);
				$bool = $st->execute($array);
				break;
		}
		$this->clear();
		return $bool;
	}
	protected function clear()
	{
		foreach ($this as $property => $value) {
			if ($property == 'handler') {
				continue;
			}
			$this->$property = null;
		}
	}
	public function update($data)
	{
		/**
		 * 1 {column, value}
		 * 2 {{column1, value1}, ..}
		 */
		$this->query_type = 'UPDATE';
		
		if (is_array($data[0])) {
			// case 2
			foreach ($data as $line) {
				$this->inserts []= $this->parseName($line[0]);
				$this->insert_values []= $line[1];
			}
		} else {
			// case 1
			$this->inserts []= $this->parseName($data[0]);
			$this->insert_values []= $data[1];
		}
		
		return $this;
	}
}
?>
<?php
abstract class Application_Model_Abstract_Notprimary 
{
	protected  $_dbTable;
	protected  $_rows;
	
	public function __construct()
	{
		$rows = $this->_dbTable->fetchAll();
		foreach ($rows as $row)
		{
			$this->_rows[$row['key']] = $row['value'];
		}
	}
	public function __get($name)
	{
		if (isset($this->_rows[$name]))
		{
			return $this->_rows[$name];
		}
	}
	public function __set($name,$value)
	{
		$row = $this->_dbTable->find($name)->current();
		if (isset($row))
		{
			$row->value = $value;
			$row->save();
		}
	
	}
	public function fetchAll()
	{
		return $this->_dbTable->fetchAll();
	}
	public function getAllConfig()
	{
		return $this->_rows;
	}
	
}
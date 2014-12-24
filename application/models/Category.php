<?php

class Application_Model_Category extends Application_Model_Abstract_Model
{

	public function __construct($id = null) {
		$this->_dbTable = new Application_Model_DbTable_Category();
		parent::__construct($id);
	}

}


<?php

class Application_Model_Members extends Application_Model_Abstract_Model
{
	public function __construct($id = null)
	{
		$this->_dbTable = new Application_Model_DbTable_Members();
		parent::__construct($id);
	}

	/**
	 * 
	 * @param unknown $user
	 * @param unknown $pass
	 * @param number $remember
	 * @return boolean
	 */
	public function athorize($user,$pass,$remember = 0)
	{
		//var_dump($user,$pass);
		$auth = Zend_Auth::getInstance();
		//$ip = ip2long((isset($_SERVER['HTTP_X_REAL_IP'])?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR']));
		$authAdapter = new Zend_Auth_Adapter_DbTable(
				Zend_Db_Table::getDefaultAdapter(),
				'members',
				'username',
				'password',
				"SHA1(CONCAT(?,testsalt)) and status = 1");
		$authAdapter->setIdentity($user);
		$authAdapter->setCredential($pass);
	
		$result = $auth->authenticate($authAdapter);
		
		if($result->isValid()){
			$storage = $auth->getStorage();
			$data = $authAdapter->getResultRowObject(null,array('password'));
			//$data->lastActive = time();
			$storage->write($data);
			// Получить объект Zend_Session_Namespace
			$session = new Zend_Session_Namespace('Zend_Auth');
			// Установить время действия залогинености
			$session->setExpirationSeconds(24*3600);
			//$this->view->user = Zend_Auth::getInstance()->getIdentity();
			// если отметили "запомнить"
			if ($remember == 1) {
				Zend_Session::rememberMe();
			}
			return true;
		}else {
			return $result->getMessages();
			//var_dump($result->getMessages());
		}
		return false;
	}
	public function registration($data,$role = 'member')
	{
		$ip =  (isset($_SERVER['HTTP_X_REAL_IP'])?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR']);
		$this->_row = $this->_dbTable->createRow();

		$this->_row->username = $data['mylogin'];
		$this->_row->password = sha1($data['mypassword'].$solt);
		$this->_row->testsalt = $solt;
		// profile
		$this->_row->name = $data['name'];
		$this->_row->email = $data['myemail'];
		$this->_row->role = $role;
		$this->_row->status = 1;
		$this->_row->save();
		return $this->_row->id;
	}
	

}


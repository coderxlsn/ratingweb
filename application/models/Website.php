<?php

class Application_Model_Website extends Application_Model_Abstract_Model
{
	public function __construct($id = null)
	{
		$this->_dbTable = new Application_Model_DbTable_Website();
		parent::__construct($id);
	}
	/**
	 * Показ страницы
	 * @param unknown $id
	 * @param unknown $url
	 * @return Ambigous <Zend_Db_Table_Row_Abstract, NULL>
	 */
	public function view($id,$url){
		return $this->_dbTable->fetchRow(array('id = ?'=>$id,'uri  = ?'=>$url));
	}
	/**
	 * Поиск по урлу
	 * @param unknown $url
	 * @return multitype:multitype:unknown string Ambigous <>
	 */
	public function search($url){
		$res = $this->_dbTable->fetchAll(array('url LIKE ?'=>$url.'%'),'url ASC');
		$result = array();
		foreach ($res as $row){
			$u = sprintf('/view/%d-%s.html',$row['id'],$row['uri']);
			$result[] = array('id'=>$row['id'],'name'=>$row['name'],'uri'=>$u);
		}
		return $result;
	}
	public function genScreenshot($url){

		$api = 	"";
		$client = new  Zend_Http_Client();
		$u = sprintf('http://api.thumbalizr.com/?api_key=%s&width=230&url=%s',$api,$url);
		
	}
}
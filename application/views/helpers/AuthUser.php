<?php

class Application_View_Helper_AuthUser extends Zend_View_Helper_Abstract
{

	public function authUser()
	{
		$auth = Zend_Auth::getInstance();
		$view = clone $this->view;
		if ($auth->hasIdentity()){
		
			$view->userinfo = $auth->getIdentity();
			return $view->render('helpers/authInfo.phtml');
		}else {
			return $view->render('helpers/notAuthInfo.phtml');
		}
	}
}
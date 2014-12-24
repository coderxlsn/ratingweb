<?php



class Application_View_Helper_Login extends Zend_View_Helper_Abstract
{
	
	public function login()
	{
		$form= new Application_Form_Login();
		$view = clone $this->view;
		$view->form = $form;
		return $view->render('helpers/login.phtml');
	}
}
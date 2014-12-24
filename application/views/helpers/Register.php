<?php



class Application_View_Helper_Register extends Zend_View_Helper_Abstract
{
	
	public function register()
	{
		$form= new Application_Form_Register();
		$view = clone $this->view;
		$view->form = $form;
		return $view->render('helpers/register.phtml');
	}
}
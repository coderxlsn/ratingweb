<?php

class AjaxController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
		$ajaxContext = $this->_helper->getHelper('contextSwitch');
		$ajaxContext->addActionContext('login', 'json')

		->addActionContext('search', 'json')
		->initContext();
	}
	public function regAction()
	{
		Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setNoRender(true);
		Zend_Layout::getMvcInstance()->disableLayout();
		$form = new Application_Form_Register();
		$result = 'Error';
		if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		{
			$result = 'Ok';
		
		}else{
			print_r($form->getMessages());
		}
		echo $result;
	}
	public function loginAction(){
		Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setNoRender(true);
		Zend_Layout::getMvcInstance()->disableLayout();
		$form = new Application_Form_Login();
		$result = 'Error';
		if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		{
			$user = new Application_Model_Members();
			 
			$auth = $user->athorize($form->getValue('login'), $form->getValue('pass'),$form->getValue('remember'));
			if ($auth ===true)
			{
				//$this->_redirect('/');
				$result = 'Ok';
			}
			 
		}
		echo $result;
	}
	public function searchAction()
	{
		
		$key = $this->getRequest()->getParam('key');
		$model = new Application_Model_Website();
		$result = $model->search($key);
		$this->_helper->json($result);
	}

}
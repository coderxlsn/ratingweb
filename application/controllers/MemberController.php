<?php

class MemberController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        // action body
        $form = new Application_Form_Login();
        if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
        {
        	$user = new Application_Model_Members();
        	
        	$auth = $user->athorize($form->getValue('login'), $form->getValue('pass'),$form->getValue('remember'));
        	if ($auth ===true) 
        	{
        		//$this->_redirect('/');
        		$this->_redirect($this->getRequest()->getParam('url'));
        	}else {
        		var_dump($auth);	
        	}
        	
        }else {
        	
        }
        $this->view->form =$form;
    }
    public function logoutAction(){
    	$auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    	$this->_redirect('/');
    }


}




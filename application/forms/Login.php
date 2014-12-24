<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$login = new Zend_Form_Element_Text('login');
    	$login->setLabel('Username')
    	->setAttrib('placeholder', 'Username')->setAttrib('class', 'form_input');
    	$password = new Zend_Form_Element_Password('pass');
    	$password->setLabel('Password')->setAttrib('placeholder', 'Password')->setAttrib('class', 'form_input');;
    	$remember =new Zend_Form_Element_Checkbox('remember');
    	$remember->setLabel('Remember Me')->setAttrib('class', 'remember_me')->setAttrib('hidden', 'hidden');
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Login');
    	
    	$this->addElements(array($login,
	    	$password,
	    	$remember,
	    	$submit
    	));

    	$this->setElementDecorators(array('ViewHelper'));
    	
    }
    public function loadDefaultDecorators(){
    	$this->setDecorators(
    			array(
    					array(
    							'ViewScript',
    							array(
    									'viewScript' => 'forms/login.phtml',
    							)
    					)
    			)
    	);
    }


}


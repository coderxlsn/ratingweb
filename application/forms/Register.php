<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$login = new Zend_Form_Element_Text('login');
    	$login->setLabel('Username')
    	->setAttrib('placeholder', 'Username')->setAttrib('class', 'form_input2');
    	$name = new Zend_Form_Element_Text('name');
    	$name->setLabel('Name')
    	->setAttrib('placeholder', 'Name')->setAttrib('class', 'form_input2');
    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('email')
    	->setAttrib('placeholder', 'Email')->setAttrib('class', 'form_input2');
    	$email2 = new Zend_Form_Element_Text('email2');
    	$email2->setLabel('email')
    	->setAttrib('placeholder', 'Confirm password')->setAttrib('class', 'form_input2');
    	$password = new Zend_Form_Element_Password('pass');
    	$password->setLabel('Password')->setAttrib('placeholder', 'Password')->setAttrib('class', 'form_input2');
    	$password2 = new Zend_Form_Element_Password('pass2');
    	$password2->setLabel('Password')->setAttrib('placeholder', 'Confirm password')->setAttrib('class', 'form_input2');
    	
    	$captcha = new Zend_Form_Element_Captcha('cap',
        array('label' => "Please enter the 5  letters displayed below:",
            	'required'=>true,
            	'captcha' => array(
            		'captcha' => 'image',
		            'font'=> APPLICATION_PATH.'/../public/fonts/os.ttf',
		            'imgDir'=>APPLICATION_PATH.'/../public/img/captcha',
		            'imgUrl'=> '/img/captcha/',
		            'wordLen' => 5,
		            'fsize'=>20,
		            'height'=>48,
		            'width'=>250,
		            'gcFreq'=>1,
		            'expiration' => 300
	        )
	    ));
    	$captcha->setDecorators(array(
    			'ViewHelper',
    			'Errors',
    			array( 'HtmlTag', array('tag' => 'div', 'class' => 'captha_img'))
    	))->setAttrib('placeholder', 'Human check');
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('Login');
    	
    	$this->addElements(array($login,
    			$email,
    			$email2,
    			$name,
    			$captcha,
	    	$password,
    			$password2,
	    	
	    	$submit
    	));
    	//$this->getElement('cap')->removeDecorator("viewhelper");
    	
    	$this->setElementDecorators(array('ViewHelper'));
    	
    	
    }
    public function loadDefaultDecorators(){
    	$this->setDecorators(
    			array(
    					array(
    							'ViewScript',
    							array(
    									'viewScript' => 'forms/register.phtml',
    							)
    					)
    			)
    	);
    }


}


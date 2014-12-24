<?php



class Application_Form_AddWebsite extends Zend_Form
{
	public function init(){
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Website name');
		$url = new Zend_Form_Element_Text('url');
		$url->setLabel('Website url');
		$url->addValidator(new Zend_Validate_Db_NoRecordExists(array('table'=>'website','field'=>'url')));
		$keyword = new Zend_Form_Element_Text('keyword');
		$keyword->setLabel('Website keyword');
		$description = new Zend_Form_Element_Textarea('description');
		$description->setLabel('Description');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('Save');
		 
		$this->addElements(array(
				$name,
				$url,
				$keyword,
				$description,
				
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
										'viewScript' => 'forms/addWebsite.phtml',
								)
						)
				)
		);
	}
}
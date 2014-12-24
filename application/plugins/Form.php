<?php
class Application_Plugin_Form extends Zend_Form
{
	protected $myDecorators = array('ViewHelper',
			array(array('data' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'controls ')),
			array('Label', array('class' => 'control-label')),
			array(array('row' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'control-group'))
	);
	protected $myDecorators1 = array('ViewHelper',
			array(array('data' => 'HtmlTag'),
					array('tag' => 'div', 'class' => ' span1','style' => 'margin-left: 17px;')),
			array('Label', array('class' => 'control-label span2')),
			array(array('row' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'row-fluid control-group', 'openOnly' => true))
	);
	protected $appendDecorator = array('ViewHelper',
			array(array('data' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'span2','style' => 'margin-left: 0px;padding-top: 1px;')),
			array('Label', array('class' => 'span1','style' => 'width: 15px;padding-top: 5px;margin-left: 49px;')),
			array(array('row' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'row-fluid', 'closeOnly' => true))
	);
	protected $submit = array('ViewHelper',
			array(array('row' => 'HtmlTag'),
					array('tag' => 'div', 'class' => 'form-actions'))
	);
	
	public function isValid($data)
    {
        $valid = parent::isValid($data);
        
 
        foreach ($this->getElements() as $element) {
            if ($element->hasErrors()) {
                $oldClass = $element->getAttrib('class');
                $type = $element->getDecorator('row')->getOption('class');
                if ($type  == 'row-fluid control-group') {
                   // $element->setAttrib('class', $oldClass . ' error');
                   $element->addDecorator(array('row' => 'HtmlTag'), array('tag' => 'div','class'=>'row-fluid control-group error','openOnly' => true));
                } else {
                	$element->addDecorator(array('row' => 'HtmlTag'), array('tag' => 'div','class'=>'control-group error'));
                    //$element->setAttrib('class', 'error');
                }
                
            }
        }
 
        return $valid;
    }
    
}
<?php



class Application_View_Helper_SearchHtml extends Zend_View_Helper_Abstract
{
	
	public function searchHtml()
	{

		$view = clone $this->view;

		return $view->render('helpers/searchHtml.phtml');
	}
}
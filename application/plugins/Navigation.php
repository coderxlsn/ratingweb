<?php
/**
 * Плагин загрузки меню для модуля, если есть
 * @author артур
 *
 */
class Application_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$module = $request->getModuleName();
    	if(empty($module)) $module = "default";
    	$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->initView();
        $view = $viewRenderer->view;
        $moduleDir = Zend_Controller_Front::getInstance()->getModuleDirectory();
        if(file_exists($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'navigation.xml')) {
        	$config = new Zend_Config_Xml($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'navigation.xml', 'nav');
    		$navigation = new Zend_Navigation($config);
    		
    		$view->navigation($navigation)
    		->setTranslator(Zend_Registry::get('Zend_Translate'));
        }
	}
}
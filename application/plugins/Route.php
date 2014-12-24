<?php
/**
 * Плагин загрузки роутров для модуля, если есть
 * @author артур
 *
 */
class Application_Plugin_Route extends Zend_Controller_Plugin_Abstract
{
	public function routeStartup(Zend_Controller_Request_Abstract $request)
	{
		
        $frontController = Zend_Controller_Front::getInstance();
		$bootstrap =  $frontController->getParam('bootstrap');
		$moduleList = $bootstrap->modules;
		$router = $frontController->getRouter();
		// главный конфиг модуля
		$moduleDir = Zend_Controller_Front::getInstance()->getModuleDirectory('default');
		if(file_exists($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'router.ini')) {
	       	$config = new Zend_Config_Ini($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'router.ini', 'production');
        	$router->addConfig($config, 'routes');
        }
        // остальные модули, если есть конфиг
        foreach ($moduleList as $module) {
        	$module = $module->getModuleName();
        	$moduleDir = Zend_Controller_Front::getInstance()->getModuleDirectory(strtolower($module));
         	if(file_exists($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'router.ini')) {
	        	$config = new Zend_Config_Ini($moduleDir .DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'router.ini', 'production');
        		$router->addConfig($config, 'routes');
        	}
        }
        return $router;
	}
	
}
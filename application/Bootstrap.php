<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initDoctype ()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('HTML5');
		$view->headTitle()->append('RatingWeb');
		$view->headTitle()->setSeparator(' | ');
		//$view->headMeta()->appendHttpEquiv('Content-Type','text/html; charset=utf-8');
	}
	
	protected function _initLayoutHelper()
	{
	
		$this->bootstrap ( 'frontController' );
		$layout = Zend_Controller_Action_HelperBroker::addHelper(
				new Application_Plugin_Layout());
		
	}
	protected function _initConfig ()
	{
		$config = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $config);
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		$view->config = $config;
		
		return $config;
	}
	
	protected function _initPlagins() {
		$this->bootstrap("frontController");
        $this->frontController->registerPlugin(new Application_Plugin_Navigation());
        $this->frontController->registerPlugin(new Application_Plugin_Route());
        $this->frontController->registerPlugin(new Application_Plugin_Translate());
		
	}
	
	protected function _initViewHelpers ()
	{
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		if (! Zend_Auth::getInstance()->hasIdentity()) {
			$view->indentity = false;

		} else {
			$view->indentity = Zend_Auth::getInstance()->getIdentity();
		}
	}
	protected function _initSyslog ()
	{
		// Zend_Log
		//$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '../var/logs/zf_log.txt'); // Websites/akrabat/application/var/logs/
		$writer = new Zend_Log_Writer_Stream(
				APPLICATION_PATH . '/data/logs/zf_log.txt'); // Websites/akrabat/var/logs/
		$logger = new Zend_Log($writer);
		Zend_Registry::set('logger', $logger);
		return $logger;
	}
	protected function _initTranslate()
	{
		// Get current registry
		$registry = Zend_Registry::getInstance();
		/**
		 * Set application wide source Locale
		 * This is usually your source string language;
		 * i.e. $this->translate('Hi I am an English String');
		*/
		$locale = new Zend_Locale('en_US');
	


		$session = new Zend_Session_Namespace('session');
		$langLocale = isset($session->lang) ? $session->lang : $locale;
		$translate = new Zend_Translate(
				array(
						'adapter' => 'gettext',
						'content' => APPLICATION_PATH . DIRECTORY_SEPARATOR .'languages/en_US.mo',
						'locale'  => 'en',
						'disableNotices' => true,    // This is a very good idea!
						'logUntranslated' => true,  // Change this if you debug
						'log'=>$registry->get('logger'),
				)
		);
		$translate->addTranslation(
				array(
						'content' => APPLICATION_PATH . DIRECTORY_SEPARATOR .'languages/ru_RU.mo',
						'locale'  => 'ru'
				)
		);
		$translate->setLocale($langLocale);
		//$translate->setLogger($registry->get('logger'));
		Zend_Form::setDefaultTranslator($translate);
		$registry->set('Zend_Locale', $locale);
		$registry->set('Zend_Translate', $translate);
		return $registry;
	}
	/* 
	protected function _initZFDebug() {
	    //if (Zend_Auth::getInstance ()->hasIdentity ()) {
    //$identity = Zend_Auth::getInstance ()->getIdentity ();
    
    $autoloader = Zend_Loader_Autoloader::getInstance ();
    $autoloader->registerNamespace ( 'ZFDebug' );
     
    $options = array ('plugins' => array ('Variables', 'File' => array ('base_path' => APPLICATION_PATH . '/../' ), 'Html', 'Memory', 'Time', 'Registry', 'Exception' ));
    # Instantiate the database adapter and setup the plugin.
    # Alternatively just add the plugin like above and rely on the autodiscovery feature.
    if ($this->hasPluginResource ( 'db' )) {
    $this->bootstrap ( 'db' );
    $db = $this->getPluginResource ( 'db' )->getDbAdapter ();
    $options ['plugins'] ['Database'] ['adapter'] = $db;
    }
    # Setup the cache plugin
    if ($this->hasPluginResource ( 'cache' )) {
    $this->bootstrap ( 'cache' );
    $cache = $this->getPluginResource ( 'cache' )->getDbAdapter ();
    $options ['plugins'] ['Cache'] ['backend'] = $cache->getBackend ();
    }
     
    $debug = new ZFDebug_Controller_Plugin_Debug ( $options );
     
    $this->bootstrap ( 'frontController' );
    $frontController = $this->getResource ( 'frontController' );
    $frontController->registerPlugin ( $debug );
    //}
    } 
    /* */
}


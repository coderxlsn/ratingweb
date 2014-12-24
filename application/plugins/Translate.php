<?php
class Application_Plugin_Translate extends Zend_Controller_Plugin_Abstract
{

	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$registry = Zend_Registry::getInstance();
		// Get our translate object from registry.
		$translate = $registry->get('Zend_Translate');
		$currLocale = $translate->getLocale();
		// Create Session block and save the locale
		$session = new Zend_Session_Namespace('session');
		
		$lang = $request->getParam('lang','');
		// Register all your "approved" locales below.
		switch($lang) {
			case "ru":
				$langLocale = 'ru_RU';
				break;
			case "en":
				$langLocale = 'en_US';
				break;
			default:
				/**
				 * Get a previously set locale from session or set
				 * the current application wide locale (set in
				 * Bootstrap)if not.
				 */
				$langLocale = isset($session->lang) ? $session->lang : $currLocale;
		}
		
		$newLocale = $registry->get('Zend_Locale');
		$newLocale->setLocale($langLocale);
		$registry->set('Zend_Locale', $newLocale);
		
		$translate->setLocale($langLocale);
		$session->lang = $langLocale;
		
		// Save the modified translate back to registry
		$registry->set('Zend_Translate', $translate);
	}
}
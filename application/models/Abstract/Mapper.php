<?php
abstract class Application_Model_Abstract_Mapper
{
	/**
	 * Валидация флоат числа
	 *
	 * @param float $amout
	 * @return float $amount valide value
	 */
	protected function  prepareAmount($amout) {
		return preg_replace("/^[0-9]+(?:.+[0-9]{1,3})*$/i", "$0", $amout);
	}
	/**
	 * Вырезаем HTML И одинарные скобки
	 * @param string $text
	 * @return string
	 */
	protected function prepareText($text)
	{
		$text = strip_tags($text);
		$text = str_replace("'", "", $text);
		return $text;
	}
	
}
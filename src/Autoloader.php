<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 19:04
 */

class Autoloader
{
	public static function register()
	{
		spl_autoload_register(function ($class) {
			$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
			if (!file_exists($file)) {
				return;
				//throw new UnexpectedValueException("File {$file} not found");
			}

			require $file;
		});
	}
}
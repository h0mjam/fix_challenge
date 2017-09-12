<?php

use interfaces\PlaylistHandler;

/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 12.09.2017
 * Time: 23:45
 */

class DefaultPlaylistHandler implements PlaylistHandler
{
	private $length;

	public function __construct($length = 10)
	{
		$this->length = $length;
	}

	/**
	 * Helper method
	 *
	 * @param $length
	 *
	 * @return static
	 */
	public static function build($length)
	{
		return new static($length);
	}

	/**
	 * Метод генерирует случайный плей-лист
	 *
	 * @return array
	 */
	public function generate() :array
	{
		return array_map(function () {
			return Song::create();
		}, range(1, 10));
	}
}
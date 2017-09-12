<?php

use Faker\Factory;

/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 18:22
 */

class Song
{
	const GENRE_POP = 1;
	const GENRE_RNB = 2;
	const GENRE_ROCK = 3;
	const GENRE_JAZZ = 4;
	const GENRE_ELECTROHOUSE = 5;
	
	public $genre;
	public $title;
	public $author;
	public $duration;

	/**
	 * @return static
	 */
	public static function create()
	{
		$faker = Factory::create();

		$instance = new static();
		$instance->title = $faker->company;
		$instance->author = $faker->name;
		$instance->duration = rand(1, 3);
		$instance->genre = $faker->randomElement([
			static::GENRE_JAZZ,
			static::GENRE_ELECTROHOUSE,
			static::GENRE_POP,
			static::GENRE_RNB,
			static::GENRE_ROCK,
		]);

		return $instance;
	}
}
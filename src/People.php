<?php

use interfaces\ListenerInterface;

/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 17:37
 */

class People implements ListenerInterface
{
	/** @var string */
	public $name;

	/** @var array  */
	private $skills = [];

	/**
	 * Фабричный метод для получения экземпляра объекта
	 *
	 * @param array $config
	 *
	 * @return \People
	 */
	public static function born(array $config = []) :self
	{
		$faker = \Faker\Factory::create();

		$instance = new static();
		$instance->name = $faker->name;
		$instance->skills = $faker->randomElements([
			Song::GENRE_POP,
			Song::GENRE_RNB,
			Song::GENRE_JAZZ,
			Song::GENRE_ROCK,
			Song::GENRE_ELECTROHOUSE,
		],2);

		return $instance;
	}

	/**
	 * Метод обработки события
	 *
	 * @param integer $type
	 * @param Event $event
	 *
	 * @return mixed|void
	 */
	public function onEvent($type, $event)
	{
		switch ($type) {
			case Club::EVENT_CHANGE_GENRE:
				$this->onChangeGenre($event->sender);
				break;

			default:
				//nope;
		}
	}

	/**
	 * @param Club $sender
	 */
	private function onChangeGenre(Club $sender)
	{
		if (in_array($sender->currentSong->genre, $this->skills)) {
			$this->dance();
		} else {
			$this->drunk();
		}
	}

	/**
	 * Танцы-танцы
	 */
	private function dance()
	{
		echo $this->name . " go dancing\n";
	}

	/**
	 * В пичали пьём
	 */
	private function drunk()
	{
		echo $this->name . " go drunk\n";
	}
}
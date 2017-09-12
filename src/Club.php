<?php

use interfaces\ListenerInterface;
use interfaces\PlaylistHandler;

/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 17:37
 */

class Club
{
	/** Событие: смена трека */
	public const EVENT_CHANGE_GENRE = 'changeGenre';

	/** @var ListenerInterface[] */
	private $listeners = [];

	/** @var array */
	private $playlist = [];

	/** @var Song */
	public $currentSong;

	public function __construct()
	{
		$playlistHandler = DefaultPlaylistHandler::build(10);
		$this->fillPlaylist($playlistHandler);
	}

	/**
	 * Добаление персонажа в список посетителей клуба
	 *
	 * @param ListenerInterface $listener
	 */
	public function addListener(ListenerInterface $listener) :void
	{
		$id = spl_object_hash($listener);

		if ($this->existListener($id)) {
			throw new InvalidArgumentException("Listener {$id} already exist");
		}

		$this->listeners[$id] = $listener;
	}

	/**
	 * Удаление персонажа из списка посетителей
	 *
	 * @param ListenerInterface $listener
	 */
	public function removeListener(ListenerInterface $listener) :void
	{
		$id = spl_object_hash($listener);

		if (!$this->existListener($id)) {
			throw new InvalidArgumentException("Listener {$id} not exist");
		}

		unset($this->listeners[$id]);
	}

	/**
	 * Метод проверки находится ли персонаж в клубе
	 *
	 * @param string $listenerId
	 *
	 * @return bool
	 */
	public function existListener(string $listenerId) :bool
	{
		return array_key_exists($listenerId, $this->listeners);
	}

	/**
	 * Метод рассылки события
	 *
	 * @param $type
	 * @param \Event|NULL $event
	 */
	public function event($type, Event $event = null)
	{
		$event = $event ?: new Event();

		if ($event->sender === null) {
			$event->sender = $this;
		}

		foreach ($this->listeners as $listener) {
			$listener->onEvent($type, $event);
		}
	}

	/**
	 * Метод наполнения плей-листа
	 *
	 * @param PlaylistHandler $handler Стратегия наполнения плей-листа
	 */
	private function fillPlaylist(PlaylistHandler $handler)
	{
		$this->playlist = $handler->generate();
	}

	/**
	 * Метод генерирует событие: смена трека
	 */
	private function changeGenre()
	{
		$this->event('changeGenre');
	}

	/**
	 * Начало вечеринки
	 */
	public function go()
	{
		/** @var Song $track */
		foreach ($this->playlist as $track) {
			echo "\n\nPlaying {$track->title} by {$track->author}\n\n";
			$this->currentSong = $track;
			$this->changeGenre();
			sleep($track->duration);
		}
	}
}
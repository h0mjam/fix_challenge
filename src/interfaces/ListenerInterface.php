<?php

namespace interfaces;

/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 17:38
 */

interface ListenerInterface
{
	/**
	 * @param $type
	 * @param $event
	 *
	 * @return mixed
	 */
	public function onEvent($type, $event);
}
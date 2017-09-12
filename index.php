<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 09.09.2017
 * Time: 17:40
 */
include 'vendor/autoload.php';
include 'src/Autoloader.php';

Autoloader::register();

$club = new Club();

// Enter peoples into club
for ($i = 0; $i < 10; $i++) {
	$club->addListener(People::born());
}

// dance
$club->go();
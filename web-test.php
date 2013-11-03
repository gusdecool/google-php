<?php
/*
 * This file for debugging with browser,
 * Sometime PHPUnit just return error with code, which hard to understand.
 * So web testing will still needed.
 */

use gusdecool\GooglePhp\Place\PlaceSearch;

require_once 'vendor/autoload.php';
require_once __DIR__.'/Config.php';

$place = new PlaceSearch(
	\Config::KEY,
	\Config::LATITUDE,
	\Config::LONGITUDE
);

$place->setOptParams('keyword', 'Bunga Mata');
$response = $place->execute();
var_dump($response);


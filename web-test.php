<?php
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


<?php
require_once __DIR__.'/vendor/autoload.php';
$google = new \GusDeCooL\GooglePhp\Google('AIzaSyB55gLF0Q8kNfFaCkw-ip6HkOJz6L9PrTQ');

// Sample google place nearby
$nearby = $google->getPlace()
	->getNearby()
	->setLocation(-8.693295, 115.177965)
	->setOptParams('keyword', 'Bunga Mata')
	->execute();
var_dump($nearby->results);



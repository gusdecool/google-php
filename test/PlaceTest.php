<?php
namespace gusdecool\GooglePhp\test;

use gusdecool\GooglePhp\Place\PlaceSearch;

class PlaceTest extends \PHPUnit_Framework_TestCase
{
	const API_KEY = 'AIzaSyB55gLF0Q8kNfFaCkw-ip6HkOJz6L9PrTQ';

	public function __construct() {
		parent::__construct();
		require_once __DIR__.'/../Config.php';
	}

	public function testSetKey()
	{

		$place = new PlaceSearch(
			\Config::KEY,
			\Config::LATITUDE,
			\Config::LONGITUDE
		);
		$this->assertEquals(\Config::KEY, $place->getKey());
	}
} 
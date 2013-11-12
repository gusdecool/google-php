<?php


namespace GusDeCooL\GooglePhp\Test;


use GusDeCooL\GooglePhp\Google;

class GoogleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @return Google
	 */
	public function testConstruct()
	{
		$google = new Google(constant('API_KEY'));
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Google', $google);

		return $google;
	}

	/**
	 * @param Google $google
	 *
	 * @depends testConstruct
	 */
	public function testGetKey(Google $google)
	{
		$this->assertEquals(constant('API_KEY'), $google->getKey());
	}

	/**
	 * @param Google $google
	 *
	 * @depends testConstruct
	 */
	public function testGetPlace(Google $google)
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Place', $google->getPlace());
	}

}
 
<?php


namespace GusDeCooL\GooglePhp\Test\Component\Place;


use GusDeCooL\GooglePhp\Component\Place\Place;

class PlaceTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Place
	 */
	private $place;

	public function setUp()
	{
		$google = $this->getMockBuilder('GusDeCooL\GooglePhp\Google')
			->setConstructorArgs(array(constant('API_KEY')))
			->getMock();
		$google->expects($this->any())
			->method('getKey')
			->will($this->returnValue(constant('API_KEY')));

		/* @var $google \GusDeCooL\GooglePhp\Google */
		$this->place = new Place($google);
	}

	public function testConstruct()
	{
		$google = $this->getMockBuilder('GusDeCooL\GooglePhp\Google')
			->setConstructorArgs(array(constant('API_KEY')))
			->getMock();

		/* @var $google \GusDeCooL\GooglePhp\Google */
		$place = new Place($google);
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Place', $place);

		return $place;
	}

	public function testGetParent()
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Place', $this->place);
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Google', $this->place->getParent());
	}

	public function testSetParent()
	{
		$google = $this->getMockBuilder('GusDeCooL\GooglePhp\Google')
			->setConstructorArgs(array('test-api'))
			->getMock();
		/* @var $google \GusDeCooL\GooglePhp\Google */

		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Place', $this->place);
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Place', $this->place->setParent($google));
	}

	/**
	 * @param Place $place
	 *
	 * @depends testConstruct
	 */
	public function testGetKey(Place $place)
	{
		$this->assertEquals(constant('API_KEY'), $place->getKey());
	}

	public function testGetNearby()
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Nearby', $this->place->getNearby());
	}
}

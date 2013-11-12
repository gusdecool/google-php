<?php


namespace GusDeCooL\GooglePhp\Test\Component\Place;

use BadMethodCallException;
use CurlException;
use GusDeCooL\GooglePhp\Component\Place\Nearby;

class NearbyTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Nearby
	 */
	private $self;

	public function setUp()
	{
		$place = $this->getMockBuilder('GusDeCooL\GooglePhp\Component\Place\Place')
			->disableOriginalConstructor()
			->getMock();
		$place->expects($this->any())
			->method('getKey')
			->will($this->returnValue(constant('API_KEY')));

		/* @var $place \GusDeCooL\GooglePhp\Component\Place\Place */
		$this->self = new Nearby($place);
	}

	public function testConstruct()
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Nearby', $this->self);
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\ChildInterface', $this->self);
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\ExecutableInterface', $this->self);
	}

	public function testResetOptParams()
	{
		$this->self->setOptParams('foo', 'foo');
		$this->assertCount(1, $this->self->getOptParams());
		$this->self->resetOptParams();
		$this->assertCount(0, $this->self->getOptParams());
	}

	/**
	 * @expectedException BadMethodCallException
	 * @expectedException CurlException
	 */
	public function textExecute()
	{
		$this->self->setLocation(constant('LATITUDE'), constant('LONGITUDE'));
		$response = $this->self->execute();
		$this->assertInternalType('string', $response);
	}

	public function testGetLocation()
	{
		$this->assertEquals(null, $this->self->getLocation());
		$this->self->setLocation('111', '222');
		$this->assertEquals('111,222', $this->self->getLocation());
	}

	public function testSetLocation()
	{
		$this->self->setLocation('111', '222');
		$this->assertEquals('111,222', $this->self->getLocation());
	}

	public function testGetKey()
	{
		$this->assertEquals(constant('API_KEY'), $this->self->getKey());
	}

	public function testGetRadius()
	{
		$this->assertGreaterThan(0, $this->self->getRadius());
	}

	public function testSetRadius()
	{
		$this->self->setRadius(1000);
		$this->assertEquals(1000, $this->self->getRadius());
	}

	public function testGetSensor()
	{
		$this->assertInternalType('string', $this->self->getSensor());
	}

	public function testSetSensor()
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Nearby', $this->self->setSensor(false));
		$this->assertEquals('false', $this->self->getSensor());
	}

	public function testGetOptParams()
	{
		$this->assertInternalType('array', $this->self->getOptParams());
	}

	public function testSetOptParams()
	{
		$this->assertInstanceOf('GusDeCooL\GooglePhp\Component\Place\Nearby', $this->self->setOptParams('maho', 'testing'));
		$this->assertArrayHasKey('maho', $this->self->getOptParams());
	}
}
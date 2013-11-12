<?php

namespace GusDeCooL\GooglePhp\Component\Place;

use GusDeCooL\GooglePhp\Component\ChildInterface;
use GusDeCooL\GooglePhp\Component\ExecutableInterface;

/**
 * Class PlaceSearch
 *
 * @package GusDeCooL\GooglePhp
 * @url https://developers.google.com/places/documentation/search
 */
class Nearby implements ChildInterface, ExecutableInterface
{

	const ENDPOINT = 'https://maps.googleapis.com/maps/api/place/nearbysearch/';

	/**
	 * The latitude/longitude around which to retrieve Place information.
	 * This must be specified as latitude,longitude.
	 *
	 * @var string latitude,longitude
	 */
	private $location;

	/**
	 * Defines the distance (in meters) within which to return Place results.
	 * The maximum allowed radius is 50 000 meters.
	 * Note that radius must not be included if
	 * rankby=distance (described under Optional parameters below) is specified.
	 *
	 * @var float
	 */
	private $radius = 10000;

	/**
	 * Indicates whether or not the Place request came
	 * from a device using a location sensor (e.g. a GPS)
	 * to determine the location sent in this request.
	 * This value must be either true or false.
	 *
	 * @var string
	 */
	private $sensor = 'true';

	/**
	 * Optional parameter
	 * Please see google documentation for optional parameters
	 *
	 * @var array
	 */
	private $optParams = array();

	/**
	 * @var Place
	 */
	private $parent;

	public function __construct(Place $place)
	{
		$this->setParent($place);
	}

	public function resetOptParams()
	{
		$this->optParams = array();
	}

	/**
	 * Execute
	 * Currently only support json
	 *
	 * @param string $output preferred output json|xml (default:json)
	 *
	 * @throws \CurlException
	 * @throws \BadMethodCallException
	 * @return \CurlResponse|false
	 */
	public function execute($output = 'json')
	{
		if($this->getLocation() === null) {
			throw new \BadMethodCallException('location must be set location before execution');
		}

		$endpoint = self::ENDPOINT.$output;
		$param = array(
			'key' => $this->getKey(),
			'location' => $this->getLocation(),
			'radius' => $this->getRadius(),
			'sensor' => $this->getSensor()
		);
		$param += $this->getOptParams();

		$curl = new \Curl();

		$response = json_decode($curl->get($endpoint, $param)->body);
		if($response !== null && $response->status == 'OK') {
			return $response;
		} else {
			throw new \CurlException('Error to execute API', 500);
		}
	}

	/**
	 * @return string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * @param float $latitude
	 * @param float $longitude
	 *
	 * @return $this
	 */
	public function setLocation($latitude, $longitude)
	{
		$this->location = $latitude.','.$longitude;

		return $this;
	}

	/**
	 * API Key
	 * @return string
	 */
	public function getKey()
	{
		return $this->parent->getKey();
	}

	/**
	 * @return float
	 */
	public function getRadius()
	{
		return $this->radius;
	}

	/**
	 * @param float $radius
	 *
	 * @return $this
	 */
	public function setRadius($radius)
	{
		$this->radius = $radius;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSensor()
	{
		return $this->sensor;
	}

	/**
	 * @param boolean $sensor
	 *
	 * @return $this
	 */
	public function setSensor($sensor)
	{
		if($sensor === true) {
			$this->sensor = 'true';
		} else {
			$this->sensor = 'false';
		}

		return $this;
	}

	/**
	 * @return array
	 */
	public function getOptParams()
	{
		return $this->optParams;
	}

	/**
	 * Set optional parameter
	 *
	 * @param string $name
	 * @param string $value
	 *
	 * @return $this
	 * @url https://developers.google.com/places/documentation/search
	 */
	public function setOptParams($name, $value)
	{
		$this->optParams[$name] = $value;

		return $this;
	}

	/**
	 * @return Place
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @param Place $parent
	 *
	 * @return $this
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;

		return $this;
	}
}
<?php

namespace gusdecool\GooglePhp\Place;

/**
 * Class PlaceSearch
 *
 * @package gusdecool\GooglePhp
 * @url https://developers.google.com/places/documentation/search
 */
class PlaceSearch extends Place
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
	private $radius;

	/**
	 * Indicates whether or not the Place request came
	 * from a device using a location sensor (e.g. a GPS)
	 * to determine the location sent in this request.
	 * This value must be either true or false.
	 *
	 * @var boolean
	 */
	private $sensor;

	/**
	 * Optional parameter
	 * Please see google documentation for optional parameters
	 *
	 * @var array
	 */
	private $optParams = array();

	/**
	 * @param string $key
	 * @param float $latitude
	 * @param float $longitude
	 * @param float $radius
	 * @param bool $sensor
	 */
	public function __construct($key, $latitude, $longitude, $radius = 100.0, $sensor = false)
	{
		$this->setKey($key);
		$this->setLocation($latitude, $longitude);
		$this->setRadius($radius);
		$this->setSensor($sensor);
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
	 * @return \CurlResponse|false
	 */
	public function execute($output = 'json')
	{
		$endpoint = self::ENDPOINT.$output;
		$param = array(
			'key' => $this->getKey(),
			'location' => $this->getLocation(),
			'radius' => $this->getRadius(),
			'sensor' => $this->getSensor()
		);
		$param += $this->getOptParams();

		$curl = new \Curl();

		// This code here is so bad, bad i'm very tired to complete this :(
		// @TODO: Create generic class to
		$response = json_decode($curl->get($endpoint, $param)->body);
		if($response !== null && $response->status == 'OK') {
			return $response;
		} else {
			// request failed
			// This should be throw exception
			return false;
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
	 */
	public function setLocation($latitude, $longitude)
	{
		$this->location = $latitude.','.$longitude;
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
	 */
	public function setRadius($radius)
	{
		$this->radius = $radius;
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
	 */
	public function setSensor($sensor)
	{
		if($sensor === true) {
			$this->sensor = 'true';
		} else {
			$this->sensor = 'false';
		}

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
	 */
	public function setOptParams($name, $value)
	{
		$this->optParams[$name] = $value;
	}
}
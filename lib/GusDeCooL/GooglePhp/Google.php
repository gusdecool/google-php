<?php



namespace GusDeCooL\GooglePhp;

use GusDeCooL\GooglePhp\Component\Place\Place;

class Google
{

	/**
	 * Google API Key
	 *
	 * @var string
	 */
	private $key;

	/**
	 * @var Place
	 */
	private $place;

	/**
	 * @param $key
	 */
	public function __construct($key)
	{
		$this->setKey($key);
	}

	/**
	 * @return string
	 */
	final public function getKey()
	{
		return $this->key;
	}

	/**
	 * @param string $key
	 *
	 * @return $this
	 */
	private function setKey($key)
	{
		$this->key = $key;

		return $this;
	}

	/**
	 * @return Place
	 */
	public function getPlace()
	{
		if($this->place == null) {
			$this->setPlace();
		}

		return $this->place;
	}

	/**
	 * @return $this
	 */
	private function setPlace()
	{
		$this->place = new Place($this);

		return $this;
	}
} 
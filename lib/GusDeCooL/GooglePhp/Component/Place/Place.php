<?php



namespace GusDeCooL\GooglePhp\Component\Place;

use GusDeCooL\GooglePhp\Component\ChildInterface;
use GusDeCooL\GooglePhp\Google;

class Place implements ChildInterface
{
	/**
	 * @var Google
	 */
	private $parent;

	/**
	 * @var Nearby
	 */
	private $nearby;

	public function __construct(Google $parent)
	{
		$this->setParent($parent);
	}

	/**
	 * @return \gusdecool\GooglePhp\Google
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @param \gusdecool\GooglePhp\Google $parent
	 *
	 * @return $this
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;
		return $this;
	}

	/**
	 * @return \GusDeCooL\GooglePhp\Component\Place\Nearby
	 */
	public function getNearby()
	{
		if($this->nearby === null) {
			$this->setNearby();
		}

		return $this->nearby;
	}

	/**
	 * @return $this
	 */
	private function setNearby()
	{
		$this->nearby = new Nearby($this);
		return $this;
	}


	/**
	 * API Key
	 * @return string
	 */
	public function getKey()
	{
		return $this->getParent()->getKey();
	}
}
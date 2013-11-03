<?php



namespace gusdecool\GooglePhp\Core;


abstract class Core
{

	/**
	 * Your application's API key.
	 * This key identifies your application for purposes of quota management
	 * and so that Places added from your application are made immediately available to your app.
	 * Visit the APIs Console to create an API Project and obtain your key.
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @param string $apiKey
	 */
	public function setKey($apiKey)
	{
		$this->key = $apiKey;
	}

	abstract public function execute();
} 
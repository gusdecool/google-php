<?php



namespace GusDeCooL\GooglePhp\Component;


interface ChildInterface {
	public function getParent();
	public function setParent($parent);

	/**
	 * API Key
	 * @return string
	 */
	public function getKey();
} 